<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'contributory_calculator',
    'Configuration/TypoScript',
    'ContributoryCalculator'
);
