<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
     * @var string
     */
    protected $valueAbove3 = '0,00';

    protected $valueBelow3 = '0,00';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getValueAbove3(): string
    {
        return $this->valueAbove3;
    }

    public function setValueAbove3(string $valueAbove3): void
    {
        $this->valueAbove3 = $valueAbove3;
    }

    public function getValueBelow3(): string
    {
        return $this->valueBelow3;
    }

    public function setValueBelow3(string $valueBelow3): void
    {
        $this->valueBelow3 = $valueBelow3;
    }
}
