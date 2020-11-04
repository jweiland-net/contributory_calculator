<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Service;

use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Service\Exception\EmptyFactorException;

/**
 * Class Calculator
 */
class Calculator
{
    public function getTotalPerMonth(Search $search): float
    {
        $chargeableIncome = $search->getChargeableIncome();
        if ($chargeableIncome < 25000) {
            return 0.0;
        }

        if ($chargeableIncome > 70000) {
            $chargeableIncome = 70000;
        }

        $this->validateSearch($search);
        $result = $chargeableIncome * ($this->getFactor($search) / 100) / 11;
        return floor($result);
    }

    protected function validateSearch(Search $search): void
    {
        if (!$search->getCare() instanceof Care) {
            throw new \Exception('Given care form was not found in our database', 1604480281);
        }
        if (!in_array($search->getAgeOfChild(), [1, 2], true)) {
            throw new \Exception('You have chosen an invalid age range for your child', 1604480406);
        }
    }

    protected function getFactor(Search $search): float
    {
        $value = $search->getCare()->getValueForSearch($search);
        if (empty($value)) {
            throw new EmptyFactorException('Child is too old for this kind of care form.', 1604482527);
        }
        return $this->convertStringToFloat($value);
    }

    protected function convertStringToFloat(string $value): float
    {
        if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
            // $value = 1.234,56 ==> 1234.56
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } elseif (strpos($value, ',') !== false) {
            // $value = 8,5 ==> 8.5
            $value = str_replace(',', '.', $value);
        }
        return (float)$value;
    }
}
