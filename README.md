# igc2kmz Installer
Install Python script [igc2kmz](https://github.com/twpayne/igc2kmz) in your PHP project with ease.

This package complements [igc2kmz-php](https://github.com/m165437/igc2kmz-php), a PHP wrapper for Python script [igc2kmz](https://github.com/twpayne/igc2kmz).

## Installation
The recommended way to install igc2kmz-installer is composer:

```bash
composer require m165437/igc2kmz-installer
```

Add it to `scripts` in your composer.json:

```json
"scripts": {
    "install-igc2kmz": "M165437\\Igc2Kmz\\Installer::installIgc2Kmz"
}
```

You may consider adding a reference to your update and install hooks:

```json
"scripts": {
    "post-install-cmd": [
        "@install-igc2kmz"
    ],
    "post-update-cmd": [
        "@install-igc2kmz"
    ]
}
```

Upon installation, this package adds a binary `igc2kmz` to `vendor/bin` that can be passed to the constructor of [igc2kmz-php](https:\\github.com\m165437\igc2kmz-php) during instantiation.

```php
$igc2kmz = new \Igc2KmzPhp\Igc2Kmz('vendor/bin/igc2kmz');
```

See [igc2kmz-php](https:\\github.com\m165437\igc2kmz-php) for actual usage of igc2kmz in your PHP application.

## Contributing

Thank you for considering contributing to this package! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

igc2kmz-installer is licensed under the MIT License (MIT). Please see the [LICENSE](LICENSE.md) file for more information.
