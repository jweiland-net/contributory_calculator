<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.ContributoryCalculator',
    'Contributorycalculator',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang.xlf:tx_contributorycalculator'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_contributorycalculator_domain_model_chargeableincome',
    'EXT:contributory_calculator/Resources/Private/Language/locallang_csh_tx_contributorycalculator_domain_model_chargeableincome.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_contributorycalculator_domain_model_chargeableincome'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_contributorycalculator_domain_model_step',
    'EXT:contributory_calculator/Resources/Private/Language/locallang_csh_tx_contributorycalculator_domain_model_step.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_contributorycalculator_domain_model_step'
);
