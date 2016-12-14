<?php
namespace JWeiland\ContributoryCalculator\Domain\Model;
    
    /***************************************************************
     *  Copyright notice
     *  (c) 2016 Pascal Rinker <projects@jweiland.net>, jweiland.net
     *  All rights reserved
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

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
    protected $discountInPercent = 0.0;
    
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
        $this->name = $name;
    }
    
    /**
     * Returns the discountInPercent
     *
     * @return int discountInPercent
     */
    public function getDiscountInPercent()
    {
        return $this->discountInPercent;
    }
    
    /**
     * Sets the discountInPercent
     *
     * @param float $discountInPercent
     * @return void
     */
    public function setDiscountInPercent($discountInPercent)
    {
        $this->discountInPercent = $discountInPercent;
    }
}