<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Factory;

use JWeiland\ContributoryCalculator\Domain\Model\Search;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Factory to create or update a Search Model.
 * Useful to add the min/max incomes from settings
 */
class SearchFactory
{
    /**
     * @var array
     */
    protected $settings = [];

    public function __construct(ConfigurationManagerInterface $configurationManager)
    {
        $this->settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
        );
    }

    public function getSearch(?Search $search = null)
    {
        if ($search === null) {
            $search = GeneralUtility::makeInstance(Search::class);
        }

        $search->setMinChargeableIncome((int)$this->settings['minChargeableIncome']);
        $search->setMaxChargeableIncome((int)$this->settings['maxChargeableIncome']);

        return $search;
    }
}
