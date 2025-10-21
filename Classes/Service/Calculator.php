<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Service;

use JWeiland\ContributoryCalculator\Domain\Model\CalculationBase;
use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Service\Exception\EmptyFactorException;
use JWeiland\ContributoryCalculator\Service\Exception\NoCalculationBaseException;

/**
 * Class Calculator
 */
class Calculator
{
    public function getTotalPerMonth(Search $search): float
    {
        $this->validateSearch($search);
        $calculationBase = $this->getCalculationBaseForSearch($search);

        $chargeableIncome = $search->getChargeableIncome();
        if ($chargeableIncome < $calculationBase->getMinimalIncome()) {
            return 0.0;
        }

        if ($chargeableIncome > $calculationBase->getMaximumIncome()) {
            $chargeableIncome = $calculationBase->getMaximumIncome();
        }

        $result = $chargeableIncome * ($this->getFactor($search, $calculationBase) / 100) / 11;

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

    protected function getFactor(Search $search, CalculationBase $calculationBase): float
    {
        $value = $calculationBase->getValueForSearch($search);
        if (empty($value)) {
            throw new EmptyFactorException('Child is too old for this kind of care form.', 1604482527);
        }

        return $value;
    }

    protected function getCalculationBaseForSearch(Search $search): CalculationBase
    {
        $yearOfValidity = $search->getYearOfValidity();
        foreach ($search->getCare()->getCalculationBases() as $calculationBase) {
            if ($calculationBase->getYearOfValidity() === $yearOfValidity) {
                return $calculationBase;
            }
        }

        throw new NoCalculationBaseException('Could not find a calculation base for given search!', 1633102788189);
    }
}
