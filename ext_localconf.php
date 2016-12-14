<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

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
