<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Service\Exception;

/**
 * This Exception will be thrown, if factor in percent is empty.
 * This will mostly happen on care forms for children older than 3 years.
 */
class EmptyFactorException extends \Exception
{
}
