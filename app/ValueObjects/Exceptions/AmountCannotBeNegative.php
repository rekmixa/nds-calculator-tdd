<?php

declare(strict_types=1);

namespace App\ValueObjects\Exceptions;

use DomainException;

final class AmountCannotBeNegative extends DomainException
{
}
