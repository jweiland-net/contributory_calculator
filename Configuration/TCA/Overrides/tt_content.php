<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::registerPlugin(
    'ContributoryCalculator',
    'Contributorycalculator',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:plugin.contributorycalculator.title'
);
