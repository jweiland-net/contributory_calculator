<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Domain model which represents the different kinds of care forms
 */
class Care extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var ObjectStorage<CalculationBase>
     */
    protected $calculationBases;

    public function __construct()
    {
        $this->calculationBases = new ObjectStorage();
    }

    /**
     * Called again with initialize object, as fetching an entity from the DB does not use the constructor
     */
    public function initializeObject(): void
    {
        $this->calculationBases = $this->calculationBases ?? new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ObjectStorage|CalculationBase[]
     */
    public function getCalculationBases(): ObjectStorage
    {
        return $this->calculationBases;
    }

    public function setCalculationBases(ObjectStorage $calculationBases): void
    {
        $this->calculationBases = $calculationBases;
    }
}
