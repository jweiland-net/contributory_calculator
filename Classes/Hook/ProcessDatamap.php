<?php
namespace JWeiland\ContributoryCalculator\Hook;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Class ProcessDatamap
 *
 * @package JWeiland\ContributoryCalculator\Hook
 */
class ProcessDatamap
{
    /**
     * Validate hourly rates and convert them to a value with 3 decimals
     *
     * @param array $incomingFieldArray
     * @param string $table
     * @param string|int $id
     * @param DataHandler $dataHandler
     * @return void
     */
    public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $dataHandler)
    {
        if ($incomingFieldArray['list_type'] == 'contributorycalculator_contributorycalculator') {
            if (isset($incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateUnder3Years']['vDEF'])) {
                $value = &$incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateUnder3Years']['vDEF'];
                $value = number_format($value, 3, '.', '');
            }
            if (isset($incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateAbove3Years']['vDEF'])) {
                $value = &$incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateAbove3Years']['vDEF'];
                $value = number_format($value, 3, '.', '');
            }
        }
    }
}