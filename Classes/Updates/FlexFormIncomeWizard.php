<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Updates;

use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\ChattyInterface;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

final class FlexFormIncomeWizard implements UpgradeWizardInterface, ChattyInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function getIdentifier(): string
    {
        return 'contributoryCalculator_flexFormIncomeWizard';
    }

    public function getTitle(): string
    {
        return '[contributory_calculator] Migrate minimal and maximum income from FlexForm to all CalculationBase';
    }

    public function getDescription(): string
    {
        return <<<DESCRIPTION
Migrate the minimal and maximum income values from the first FlexForm settings to all CalculatioBase records.
Attention: 
1. Execute this upgrade wizard AFTER "Migrate old calculation base for new structure"!
2. Try to set these values manually if you use the plugin multiple times with various income values!
DESCRIPTION;
    }

    public function executeUpdate(): bool
    {
        $flexFormSettings = $this->getFlexFormSettingsToMigrate();
        $minimalIncome = (int)($flexFormSettings['data']['sDEFAULT']['lDEF']['settings.minChargeableIncome']['vDEF'] ?? 0);
        $maximumIncome = (int)($flexFormSettings['data']['sDEFAULT']['lDEF']['settings.maxChargeableIncome']['vDEF'] ?? 0);
        if (!$minimalIncome || !$maximumIncome) {
            $this->output->writeln('Minimum or maximum income of flex form could not be migrated!');
            $this->output->writeln('Flex form settings: ' . json_encode($flexFormSettings));
            return false;
        }

        $calculationBaseConnection = $this->getConnectionPool()->getConnectionForTable('tx_contributorycalculator_domain_model_calculationbase');
        $calculationBaseConnection->update(
            'tx_contributorycalculator_domain_model_calculationbase',
            [
                'minimal_income' => $minimalIncome,
                'maximum_income' => $maximumIncome,
            ],
            [
                'deleted' => 0,
            ]
        );

        $ttContentConnection = $this->getConnectionPool()->getConnectionForTable('tt_content');
        $ttContentConnection->update(
            'tt_content',
            ['pi_flexform' => ''],
            ['list_type' => 'contributorycalculator_contributorycalculator']
        );

        return true;
    }

    public function updateNecessary(): bool
    {
        return $this->getFlexFormSettingsToMigrate() !== [];
    }

    private function getFlexFormSettingsToMigrate(): array
    {
        $ttContentQueryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');

        try {
            $firstRecord = $ttContentQueryBuilder
                ->select('t.pi_flexform')
                ->from('tt_content', 't')
                ->where(
                    $ttContentQueryBuilder->expr()->neq('t.pi_flexform', '""'),
                    $ttContentQueryBuilder->expr()->eq(
                        't.list_type',
                        $ttContentQueryBuilder->createNamedParameter('contributorycalculator_contributorycalculator')
                    )
                )
                ->execute()
                ->fetch();
            $result = GeneralUtility::xml2array($firstRecord['pi_flexform']);
            if (!is_array($result)) {
                $result = [];
            }
        } catch (\Exception $exception) {
            $result = [];
        }

        return $result;
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [DatabaseUpdatedPrerequisite::class];
    }

    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
