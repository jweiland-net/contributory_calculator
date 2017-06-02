<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['contributory_calculator'] = 'JWeiland\\ContributoryCalculator\\Hook\\ProcessDatamap';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.' . $_EXTKEY,
    'Contributorycalculator',
    array(
        'Search' => 'search, result',
    ),
    // non-cacheable actions
    array(
        'Search' => 'search, result',
    )
);
