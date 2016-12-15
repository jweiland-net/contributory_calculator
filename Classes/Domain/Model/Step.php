<?php
namespace JWeiland\ContributoryCalculator\Domain\Model;
    
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

/**
 * Step
 */
class Step extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    
    /**
     * The name of the child
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';
    
    /**
     * Discount for this child
     *
     * @var int
     */
    protected $discountInPercent = 0;
    
    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = trim($name);
    }
    
    /**
     * Returns the discountInPercent
     *
     * @return int discountInPercent
     */
    public function getDiscountInPercent()
    {
        return (int)$this->discountInPercent;
    }
    
    /**
     * Sets the discountInPercent
     *
     * @param int $discountInPercent
     * @return void
     */
    public function setDiscountInPercent($discountInPercent)
    {
        $this->discountInPercent = $discountInPercent;
    }
}