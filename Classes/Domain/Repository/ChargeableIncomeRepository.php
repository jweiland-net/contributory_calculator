<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class StepRepository
 */
class ChargeableIncomeRepository extends Repository
{
    /**
     * Find all records and sort them
     * ascending by maximal income
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllSortedByMaximalIncome()
    {
        return $this->createQuery()->setOrderings(
            ['minimalIncome' => QueryInterface::ORDER_DESCENDING]
        )->execute();
    }
}
