<?php

declare(strict_types=1);

namespace App\Services;

use App\ValueObjects\Amount;
use App\ValueObjects\Nds;

final class NdsCalculator
{
    public function addNdsToAmount(Amount $amount, Nds $nds): Amount
    {
        return $amount->add($amount->multiply(Amount::fromFloat($nds->getValue() / 100)));
    }

    public function extractNdsFromAmount(Amount $amount, Nds $nds): Amount
    {
        $ndsNumber = ($nds->getValue() / 100) + 1;
        $result = $amount->getValue() / $ndsNumber;
        $result -= $amount->getValue();
        $result *= -1;
        $result = (float)number_format($result, 2);

        return Amount::fromFloat($result);
    }
}
