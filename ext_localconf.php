<?php

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

use JWeiland\ContributoryCalculator\Controller\SearchController;
use JWeiland\ContributoryCalculator\Updates\CalculationBaseWizard;
use JWeiland\ContributoryCalculator\Updates\FlexFormIncomeWizard;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(static function () {
    ExtensionUtility::configurePlugin(
        'ContributoryCalculator',
        'Contributorycalculator',
        [
            SearchController::class => 'search, result',
        ],
        // non-cacheable actions
        [
            SearchController::class => 'result',
        ],
    );

    // Add calculator plugin to new element wizard
    ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:contributory_calculator/Configuration/TSconfig/ContentElementWizard.tsconfig">',
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        'ext-contributorycalculator-wizard-icon' => 'plugin_wizard.svg',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

    foreach ($svgIcons as $identifier => $fileName) {
    }

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['contributoryCalculator_calculationBaseWizard']
        = CalculationBaseWizard::class;

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['contributoryCalculator_flexFormIncomeWizard']
        = FlexFormIncomeWizard::class;
});
