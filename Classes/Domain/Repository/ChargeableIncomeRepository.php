<?php
namespace JWeiland\ContributoryCalculator\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class StepRepository
 *
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
            array('minimalIncome' => QueryInterface::ORDER_DESCENDING)
        )->execute();
    }
}