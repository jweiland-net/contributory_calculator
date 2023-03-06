<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Controller;

use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Repository\CareRepository;
use JWeiland\ContributoryCalculator\Helper\SearchFormHelper;
use JWeiland\ContributoryCalculator\Service\Calculator;
use JWeiland\ContributoryCalculator\Service\Exception\EmptyFactorException;
use JWeiland\ContributoryCalculator\Service\Exception\NoCalculationBaseException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Controller to show search form and search results.
 */
class SearchController extends ActionController
{
    /**
     * @var CareRepository
     */
    protected $careRepository;

    /**
     * @var SearchFormHelper
     */
    protected $searchFormHelper;

    public function __construct(
        CareRepository $chargeableIncomeRepository,
        SearchFormHelper $searchFormHelper
    ) {
        $this->careRepository = $chargeableIncomeRepository;
        $this->searchFormHelper = $searchFormHelper;
    }

    public function searchAction(): void
    {
        $careForms = $this->careRepository->findAll();
        $this->view->assign('careForms', $careForms);
        $this->view->assign('yearsOfValidity', $this->searchFormHelper->getYearsOfValidity($careForms->toArray()));
        $this->view->assign('search', GeneralUtility::makeInstance(Search::class));
    }

    public function resultAction(Search $search): void
    {
        $calculator = GeneralUtility::makeInstance(Calculator::class);

        $careForms = $this->careRepository->findAll();
        $this->view->assign('careForms', $careForms);
        $this->view->assign('yearsOfValidity', $this->searchFormHelper->getYearsOfValidity($careForms->toArray()));
        $this->view->assign('search', $search);

        try {
            $this->view->assign('result', $calculator->getTotalPerMonth($search));
        } catch (EmptyFactorException $exception) {
            $this->addFlashMessage(
                LocalizationUtility::translate('error.childTooYoung.description', 'contributoryCalculator'),
                LocalizationUtility::translate('error.childTooYoung.title', 'contributoryCalculator'),
                AbstractMessage::WARNING
            );
            $this->view->assign('result', 0.0);
        } catch (NoCalculationBaseException $exception) {
            $this->addFlashMessage(
                LocalizationUtility::translate(
                    'error.noCalculationBase.description',
                    'contributoryCalculator',
                    [$search->getYearOfValidity()]
                ),
                LocalizationUtility::translate('error.noCalculationBase.title', 'contributoryCalculator'),
                AbstractMessage::WARNING
            );
            $this->view->assign('result', 0.0);
        }
    }
}
