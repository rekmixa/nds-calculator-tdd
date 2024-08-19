<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\NdsCalculator;
use App\ValueObjects\Amount;
use App\ValueObjects\Nds;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[UsesClass(NdsCalculator::class)]
#[CoversMethod(NdsCalculator::class, 'extractNdsFromAmount')]
final class NdsCalculatorExtractTest extends TestCase
{
    public static function extractNdsFromAmountProvider(): array
    {
        return [
            [Amount::fromInt(200), Amount::fromInt(1200), Nds::fromInt(20)],
            [Amount::fromInt(2), Amount::fromInt(12), Nds::fromInt(20)],
            [Amount::fromFloat(49.95), Amount::fromFloat(1048.95), Nds::fromInt(5)],
            [Amount::fromFloat(49.98), Amount::fromFloat(1049.53), Nds::fromInt(5)],
            [Amount::fromInt(0), Amount::fromInt(777), Nds::fromInt(0)],
        ];
    }

    #[DataProvider('extractNdsFromAmountProvider')]
    public function testExtractNdsFromAmount(Amount $expectedAmount, Amount $amount, Nds $nds): void
    {
        $ndsCalculator = new NdsCalculator();
        $result = $ndsCalculator->extractNdsFromAmount($amount, $nds);

        self::assertTrue(
            $result->equals($expectedAmount),
            'Expected: ' . $expectedAmount->getValue() . ', Actual: ' . $result->getValue(),
        );
    }
}
