<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Hook;

use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Class ProcessDatamap
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
     */
    public function processDatamap_preProcessFieldArray(array &$incomingFieldArray, string $table, $id, DataHandler $dataHandler): void
    {
        if ($incomingFieldArray['list_type'] === 'contributorycalculator_contributorycalculator') {
            if (isset($incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateUnder3Years']['vDEF'])) {
                $value = &$incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateUnder3Years']['vDEF'];
                $value = number_format((float)$value, 3, '.', '');
            }
            if (isset($incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateAbove3Years']['vDEF'])) {
                $value = &$incomingFieldArray['pi_flexform']['data']['sDEFAULT']['lDEF']['settings.hourlyRateAbove3Years']['vDEF'];
                $value = number_format((float)$value, 3, '.', '');
            }
        }
    }
}
