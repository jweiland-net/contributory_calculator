<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'JWeiland.ContributoryCalculator',
        'Contributorycalculator',
        [
            'Search' => 'search, result',
        ],
        // non-cacheable actions
        [
            'Search' => 'result',
        ]
    );

    // add calculator plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:contributory_calculator/Configuration/TSconfig/ContentElementWizard.txt">'
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        'ext-contributorycalculator-wizard-icon' => 'plugin_wizard.svg',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    foreach ($svgIcons as $identifier => $fileName) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:contributory_calculator/Resources/Public/Icons/' . $fileName]
        );
    }

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['contributoryCalculator_calculationBaseWizard']
        = \JWeiland\ContributoryCalculator\Updates\CalculationBaseWizard::class;
});
