<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\ValueObjects\Amount;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Amount::class)]
final class AmountValueObjectTest extends TestCase
{
    public function testCreateFromInt(): void
    {
        self::assertEquals(expected: 0, actual: Amount::fromInt(0)->getValue());
        self::assertEquals(expected: -10, actual: Amount::fromInt(-10)->getValue());
        self::assertEquals(expected: 10, actual: Amount::fromInt(10)->getValue());
        self::assertEquals(expected: 20, actual: Amount::fromInt(20)->getValue());
        self::assertEquals(expected: 20_000, actual: Amount::fromInt(20_000)->getValue());
    }

    public function testCreateFromFloat(): void
    {
        self::assertEquals(expected: 0, actual: Amount::fromFloat(0)->getValue());
        self::assertEquals(expected: -10.5, actual: Amount::fromFloat(-10.5)->getValue());
        self::assertEquals(expected: 10.5, actual: Amount::fromFloat(10.5)->getValue());
        self::assertEquals(expected: 20.3, actual: Amount::fromFloat(20.3)->getValue());
        self::assertEquals(expected: 20_000.99, actual: Amount::fromFloat(20_000.99)->getValue());
    }

    public function testAdd(): void
    {
        self::assertEquals(expected: 150, actual: Amount::fromInt(100)->add(Amount::fromInt(50))->getValue());
    }

    public function testSubtract(): void
    {
        self::assertEquals(expected: 50, actual: Amount::fromInt(100)->subtract(Amount::fromInt(50))->getValue());
    }

    public function testMultiply(): void
    {
        self::assertEquals(expected: 200, actual: Amount::fromInt(100)->multiply(Amount::fromInt(2))->getValue());
    }

    public function testDivide(): void
    {
        self::assertEquals(expected: 50, actual: Amount::fromInt(100)->divide(Amount::fromInt(2))->getValue());
    }

    public function testInvertSign(): void
    {
        self::assertEquals(expected: -100, actual: Amount::fromInt(100)->invertSign()->getValue());
    }

    public function testNormalize(): void
    {
        self::assertEquals(expected: 100.55, actual: Amount::fromFloat(100.54999)->normalize()->getValue());
    }

    public function testEquals(): void
    {
        self::assertTrue(Amount::fromInt(100)->equals(Amount::fromInt(100)));
        self::assertTrue(Amount::fromInt(100)->equals(Amount::fromFloat(100)));
        self::assertTrue(Amount::fromFloat(100)->equals(Amount::fromInt(100)));
        self::assertTrue(Amount::fromFloat(100.5)->equals(Amount::fromFloat(100.5)));
    }

    public function testNotEquals(): void
    {
        self::assertFalse(Amount::fromInt(100)->equals(Amount::fromInt(150)));
        self::assertFalse(Amount::fromInt(100)->equals(Amount::fromFloat(150)));
        self::assertFalse(Amount::fromFloat(100)->equals(Amount::fromInt(150)));
        self::assertFalse(Amount::fromFloat(100.5)->equals(Amount::fromFloat(100)));
    }
}
