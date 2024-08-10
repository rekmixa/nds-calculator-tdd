<?php

declare(strict_types=1);

namespace App\Services;

use App\ValueObjects\Amount;
use App\ValueObjects\Nds;

final class NdsCalculator
{
    public function addNdsToAmount(Amount $amount, Nds $nds): Amount
    {
        $result = $amount->getValue() * ($nds->getValue() / 100);
        $result = (float)number_format($result, 2);

        return $amount->add(Amount::fromFloat($result));
    }

    public function extractNdsFromAmount(Amount $amount, Nds $nds): Amount
    {
        $result = $amount->getValue() / (float)"1.{$nds->getValue()}";
        $result = (float)number_format($result, 2);

        return $amount->subtract(Amount::fromFloat($result));
    }
}
