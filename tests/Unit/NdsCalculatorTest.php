<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class NdsCalculatorTest extends TestCase
{
    public function testAddNdsToSum(): void
    {
        $ndsCalculator = new NdsCalculator();

        self::assertEquals($ndsCalculator->addNdsToSum(sum: 1000, nds: 20), 1200);
        self::assertEquals($ndsCalculator->addNdsToSum(sum: 10, nds: 20), 12);
        self::assertEquals($ndsCalculator->addNdsToSum(sum: 999, nds: 5), 1048.95);
    }
}
