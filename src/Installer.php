<?php

namespace M165437\Igc2Kmz;

use Composer\Package\Package;
use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class Installer
{
    /**
     * Install Igc2Kmz
     *
     * @param Event $event
     */
    public static function installIgc2Kmz(Event $event)
    {
        $io = $event->getIO();
        $composer = $event->getComposer();
        $config = $composer->getConfig();

        $vendorDir = $config->get('vendor-dir');
        $binDir    = $config->get('bin-dir');
        $targetDir = $vendorDir . '/twpayne/igc2kmz';
        $binSource = $binDir . '/igc2kmz';
        $binTarget = $targetDir . '/bin/igc2kmz.py';

        require_once $config->get('vendor-dir') . '/autoload.php';

        $fs = new Filesystem();
        if ($fs->exists($binTarget) && $fs->exists($binSource)) {
            $io->write('  - Installing <info>igc2kmz</info> (<comment>master</comment>)');
            $io->write(sprintf('    Loading from cache', $targetDir));

            return;
        }

        $downloadManager = $composer->getDownloadManager();

        try {
            $package = self::createComposerInMemoryPackage($targetDir);
            $downloadManager->download($package, $targetDir);

            $fs->appendToFile(
                $binSource,
                "#!/bin/bash\n$(dirname \"\${BASH_SOURCE[0]}\")/../twpayne/igc2kmz/bin/igc2kmz.py \"$@\""
            );

            $process = new Process('chmod +x igc2kmz');
            $process->setWorkingDirectory($binDir);
            $process->run(function ($type, $buffer) use ($io) {
                if (!$io->isVerbose()) {
                    return;
                }
                echo $buffer;
            });

            $io->write('');
        } catch (\Exception $e) {
            $io->writeError($e->getMessage());
        }
    }

    /**
     * Create composer in memory package
     *
     * @param string $targetDir Download target dir
     * @return Package
     */
    public static function createComposerInMemoryPackage($targetDir)
    {
        $package = new Package('twpayne/igc2kmz', 'igc2kmz', 'master');
        $package->setTargetDir($targetDir);
        $package->setInstallationSource('source');
        $package->setSourceUrl('https://github.com/twpayne/igc2kmz');
        $package->setSourceType('git');
        $package->setSourceReference('master');

        return $package;
    }
}
