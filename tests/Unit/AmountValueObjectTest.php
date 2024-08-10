<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\ValueObjects\Amount;
use App\ValueObjects\Exceptions\AmountCannotBeNegative;
use PHPUnit\Framework\TestCase;

final class AmountValueObjectTest extends TestCase
{
    public function testCreateFromInt(): void
    {
        self::assertEquals(expected: 0, actual: Amount::fromInt(0)->getValue());
        self::assertEquals(expected: 10, actual: Amount::fromInt(10)->getValue());
        self::assertEquals(expected: 20, actual: Amount::fromInt(20)->getValue());
        self::assertEquals(expected: 20_000, actual: Amount::fromInt(20_000)->getValue());
    }

    public function testCreateFromFloat(): void
    {
        self::assertEquals(expected: 0, actual: Amount::fromFloat(0)->getValue());
        self::assertEquals(expected: 10.5, actual: Amount::fromFloat(10.5)->getValue());
        self::assertEquals(expected: 20.3, actual: Amount::fromFloat(20.3)->getValue());
        self::assertEquals(expected: 20_000.99, actual: Amount::fromFloat(20_000.99)->getValue());
    }

    public function testCreateWithNegativeValue(): void
    {
        self::expectException(AmountCannotBeNegative::class);

        Amount::fromInt(-1);
        Amount::fromInt(-5);
        Amount::fromInt(-10);

        Amount::fromFloat(-1);
        Amount::fromInt(-5);
        Amount::fromInt(-10);
    }
}
