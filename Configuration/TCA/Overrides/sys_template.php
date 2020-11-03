<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'contributory_calculator',
    'Configuration/TypoScript',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:plugin.contributorycalculator.title'
);
