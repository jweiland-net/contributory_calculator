<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['contributorycalculator_contributorycalculator'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['contributorycalculator_contributorycalculator'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'contributorycalculator_contributorycalculator',
    'FILE:EXT:contributory_calculator/Configuration/FlexForms/ContributoryCalculator.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.ContributoryCalculator',
    'Contributorycalculator',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang.xlf:tx_contributorycalculator'
);
