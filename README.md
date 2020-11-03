# TYPO3 Extension `contributory_calculator`

![Build Status](https://github.com/jweiland-net/contributory_calculator/workflows/CI/badge.svg)

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
