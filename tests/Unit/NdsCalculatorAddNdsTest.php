<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\NdsCalculator;
use App\ValueObjects\Amount;
use App\ValueObjects\Nds;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class NdsCalculatorAddNdsTest extends TestCase
{
    public function addNdsToAmountProvider(): array
    {
        return [
            [Amount::fromInt(1200), Amount::fromInt(1000), Nds::fromInt(20)],
            [Amount::fromInt(12), Amount::fromInt(10), Nds::fromInt(20)],
            [Amount::fromFloat(1048.95), Amount::fromInt(999), Nds::fromInt(5)],
            [Amount::fromFloat(1049.53), Amount::fromFloat(999.55), Nds::fromInt(5)],
            [Amount::fromInt(1200), Amount::fromInt(1000), Nds::fromInt(20)],
        ];
    }

    #[DataProvider('addNdsToAmountProvider')]
    public function testAddNdsToAmount(Amount $expectedAmount, Amount $amount, Nds $nds): void
    {
        $ndsCalculator = new NdsCalculator();

        self::assertTrue($ndsCalculator->addNdsToAmount($amount, $nds)->equals($expectedAmount));
    }
}
