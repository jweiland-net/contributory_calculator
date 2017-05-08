<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'JWeiland.' . $_EXTKEY,
	'Contributorycalculator',
	'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang.xlf:tx_contributorycalculator'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_contributorycalculator';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/ContributoryCalculator.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'ContributoryCalculator');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contributorycalculator_domain_model_chargeableincome', 'EXT:contributory_calculator/Resources/Private/Language/locallang_csh_tx_contributorycalculator_domain_model_chargeableincome.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_contributorycalculator_domain_model_chargeableincome');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contributorycalculator_domain_model_step', 'EXT:contributory_calculator/Resources/Private/Language/locallang_csh_tx_contributorycalculator_domain_model_step.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_contributorycalculator_domain_model_step');
