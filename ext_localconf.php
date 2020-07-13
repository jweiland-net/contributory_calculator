<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['contributory_calculator'] = JWeiland\ContributoryCalculator\Hook\ProcessDatamap::class;

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
