<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Updates;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

final class CalculationBaseWizard implements UpgradeWizardInterface
{
    public function getIdentifier(): string
    {
        return 'contributoryCalculator_calculationBaseWizard';
    }

    public function getTitle(): string
    {
        return '[contributory_calculator] Migrate old calculation base for new structure';
    }

    public function getDescription(): string
    {
        return <<<DESCRIPTION
Version 4.0 of contributory_calculator provides the new year of validity feature.
Use this upgrade wizard to migrate the old care records for version 4.0.
DESCRIPTION;
    }

    public function executeUpdate(): bool
    {
        $this->migrateCareRecords();
        return true;
    }

    private function stringToFloat(string $string): float
    {
        return (float)str_replace(',', '.', $string);
    }

    public function updateNecessary(): bool
    {
        return $this->getCareRecordsToMigrate() !== [];
    }

    private function getCareRecordsToMigrate(): array
    {
        $connection = $this->getConnectionPool()->getQueryBuilderForTable(
            'tx_contributorycalculator_domain_model_care'
        );

        try {
            $result = $connection
                ->select('*')
                ->from('tx_contributorycalculator_domain_model_care')->where($connection->expr()->or($connection->expr()->neq('value_below_3', '""'), $connection->expr()->neq('value_above_3', '""')))->executeQuery()
                ->fetchAll();
        } catch (\Throwable $throwable) {
            $result = [];
        }

        return $result;
    }

    private function migrateCareRecords(): void
    {
        $data = [];
        $modifiedUids = [];
        foreach ($this->getCareRecordsToMigrate() as $recordToMigrate) {
            $unixTimestamp = time();
            $data[] = [
                $recordToMigrate['pid'],
                $unixTimestamp,
                $unixTimestamp,
                (new \DateTime())->format('Y'),
                $this->stringToFloat($recordToMigrate['value_above_3']),
                $this->stringToFloat($recordToMigrate['value_below_3']),
                (int)$recordToMigrate['uid'],
            ];
            $modifiedUids[] = (int)$recordToMigrate['uid'];
        }

        if (!empty($data)) {
            $connection = $this->getConnectionPool()->getConnectionForTable('tx_contributorycalculator_domain_model_calculationbase');
            $connection->bulkInsert(
                'tx_contributorycalculator_domain_model_calculationbase',
                $data,
                ['pid', 'crdate', 'tstamp', 'year_of_validity', 'value_above_3', 'value_below_3', 'care_form']
            );

            $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable('tx_contributorycalculator_domain_model_care');
            $queryBuilder
                ->update('tx_contributorycalculator_domain_model_care', 'c')
                ->set('c.value_above_3', '')
                ->set('c.value_below_3', '')
                ->set('c.calculation_bases', $queryBuilder->createNamedParameter(1))->where($queryBuilder->expr()->in('uid', $modifiedUids))->executeStatement();
        }
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [DatabaseUpdatedPrerequisite::class];
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
