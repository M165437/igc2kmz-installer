# Igc2Kmz Installer
Install [igc2kmz](https://github.com/twpayne/igc2kmz) in your php project with ease.

## Installation
The recommended way to install igc2kmz-installer is composer:

```bash
composer require m165437/igc2kmz-installer
```

Add it to `scripts`:

```json
"scripts": {
    "install-igc2kmz": "M165437\\Igc2Kmz\\Installer::installIgc2Kmz"
}
```

You may also consider adding a reference to your update and install hooks:

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
