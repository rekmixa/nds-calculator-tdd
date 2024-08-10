<?php

declare(strict_types=1);

namespace App\Services;

use App\ValueObjects\Amount;
use App\ValueObjects\Nds;

final class NdsCalculator
{
    public function addNdsToAmount(Amount $amount, Nds $nds): Amount
    {
        $ndsAmount = $amount->multiply(Amount::fromFloat($nds->getValue() / 100))->normalize();

        return $amount->add($ndsAmount);
    }

    public function extractNdsFromAmount(Amount $amount, Nds $nds): Amount
    {
        return $amount
            ->divide(Amount::fromFloat(($nds->getValue() / 100) + 1))
            ->subtract($amount)
            ->invertSign()
            ->normalize();
    }
}
