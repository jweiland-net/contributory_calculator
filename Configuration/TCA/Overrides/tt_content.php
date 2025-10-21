<?php

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::registerPlugin(
    'ContributoryCalculator',
    'Contributorycalculator',
    'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:plugin.contributorycalculator.title',
);
