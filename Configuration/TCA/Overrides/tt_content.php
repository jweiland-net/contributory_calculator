<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.ContributoryCalculator',
    'Contributorycalculator',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:plugin.contributorycalculator.title'
);
