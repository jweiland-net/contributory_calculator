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
            'Search' => 'search, result',
        ]
    );

    // add calculator plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:contributory_calculator/Configuration/TSconfig/ContentElementWizard.txt">'
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['contributory_calculator']
        = JWeiland\ContributoryCalculator\Hook\ProcessDatamap::class;

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
});
