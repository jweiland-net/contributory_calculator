# TYPO3 Extension `contributory_calculator`

[![Packagist][packagist-logo-stable]][extension-packagist-url]
[![Latest Stable Version][extension-build-shield]][extension-ter-url]
[![License][LICENSE_BADGE]][extension-packagist-url]
[![Total Downloads][extension-downloads-badge]][extension-packagist-url]
[![Monthly Downloads][extension-monthly-downloads]][extension-packagist-url]
[![TYPO3 13.4][TYPO3-shield]][TYPO3-13-url]

![Build Status](https://github.com/jweiland-net/contributory_calculator/actions/workflows/ci.yml/badge.svg)

Extension to calculate contributories in the frontend.

## 1 Features

* Create records for each kind of care form.
* Define a value in percent for each care form
* Differ between children above and below 3 years

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using Composer.

Run the following command within your Composer based TYPO3 project:

```
composer require jweiland/contributory-calculator
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install `contributory_calculator` with the extension manager module.

### 2.2 Minimal setup

1) Include the static TypoScript of the extension.
2) Create care-records on a sysfolder.
3) Create a plugin on a page and select at least the sysfolder as startingpoint.

## 3 Support

Free Support is available via [GitHub Issue Tracker](https://github.com/jweiland-net/contributory_calculator/issues).

For commercial support, please contact us at [support@jweiland.net](support@jweiland.net).

<!-- MARKDOWN LINKS & IMAGES -->

[extension-build-shield]: https://poser.pugx.org/jweiland/contributory-calculator/v/stable.svg?style=for-the-badge

[extension-downloads-badge]: https://poser.pugx.org/jweiland/contributory-calculator/d/total.svg?style=for-the-badge

[extension-monthly-downloads]: https://poser.pugx.org/jweiland/contributory-calculator/d/monthly?style=for-the-badge

[extension-ter-url]: https://extensions.typo3.org/extension/contributory_calculator/

[extension-packagist-url]: https://packagist.org/packages/jweiland/contributory-calculator/

[packagist-logo-stable]: https://img.shields.io/badge/--grey.svg?style=for-the-badge&logo=packagist&logoColor=white

[TYPO3-13-url]: https://get.typo3.org/version/13

[TYPO3-shield]: https://img.shields.io/badge/TYPO3-13.4-green.svg?style=for-the-badge&logo=typo3

[LICENSE_BADGE]: https://img.shields.io/github/license/jweiland-net/contributory_calculator?label=license&style=for-the-badge
