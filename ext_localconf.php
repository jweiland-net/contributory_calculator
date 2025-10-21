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

use JWeiland\ContributoryCalculator\Controller\SearchController;
use JWeiland\ContributoryCalculator\Updates\CalculationBaseWizard;
use JWeiland\ContributoryCalculator\Updates\FlexFormIncomeWizard;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(static function () {
    ExtensionUtility::configurePlugin(
        'ContributoryCalculator',
        'Contributorycalculator',
        [
            SearchController::class => 'search, result',
        ],
        // non-cacheable actions
        [
            SearchController::class => 'result',
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );
});
