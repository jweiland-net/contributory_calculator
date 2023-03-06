<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Helper;

use JWeiland\ContributoryCalculator\Domain\Model\Care;

/**
 * Helper class for the search form
 */
class SearchFormHelper
{
    /**
     * @param Care[] $careForms
     */
    public function getYearsOfValidity(array $careForms): array
    {
        $years = [];
        foreach ($careForms as $careForm) {
            foreach ($careForm->getCalculationBases() as $calculationBase) {
                if (!in_array($calculationBase->getYearOfValidity(), $years, true)) {
                    $years[$calculationBase->getYearOfValidity()] = $calculationBase->getYearOfValidity();
                }
            }
        }
        asort($years);

        return $years;
    }
}
