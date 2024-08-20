<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\ValueObjects\Exceptions\NdsCannotBeMoreThanTwenty;
use App\ValueObjects\Exceptions\NdsCannotBeNegative;
use App\ValueObjects\Nds;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[UsesClass(Nds::class)]
#[CoversMethod(Nds::class, 'getValue')]
final class NdsValueObjectTest extends TestCase
{
    public static function largeValuesProvider(): array
    {
        return [
            [21],
            [50],
            [100],
            [200],
        ];
    }

    public function testCreateWithNormalValue(): void
    {
        self::assertEquals(expected: 20, actual: Nds::fromInt(20)->getValue());
        self::assertEquals(expected: 15, actual: Nds::fromInt(15)->getValue());
        self::assertEquals(expected: 10, actual: Nds::fromInt(10)->getValue());
        self::assertEquals(expected: 5, actual: Nds::fromInt(5)->getValue());
        self::assertEquals(expected: 0, actual: Nds::fromInt(0)->getValue());
    }

    public function testCreateWithNegativeValue(): void
    {
        self::expectException(NdsCannotBeNegative::class);

        Nds::fromInt(-1);
    }

    #[DataProvider('largeValuesProvider')]
    public function testCreateWithTooLargeValue(): void
    {
        self::expectException(NdsCannotBeMoreThanTwenty::class);

        Nds::fromInt(21);
    }

    public function testZero(): void
    {
        self::assertEquals(expected: 0, actual: Nds::zero()->getValue());
    }

    public function testEquals(): void
    {
        self::assertTrue(Nds::fromInt(20)->equals(Nds::fromInt(20)));
        self::assertTrue(Nds::fromInt(10)->equals(Nds::fromInt(10)));
        self::assertTrue(Nds::fromInt(0)->equals(Nds::fromInt(0)));
        self::assertTrue(Nds::fromInt(0)->equals(Nds::zero()));
    }

    public function testNotEquals(): void
    {
        self::assertFalse(Nds::fromInt(20)->equals(Nds::fromInt(15)));
        self::assertFalse(Nds::fromInt(10)->equals(Nds::fromInt(20)));
        self::assertFalse(Nds::fromInt(0)->equals(Nds::fromInt(1)));
        self::assertFalse(Nds::fromInt(1)->equals(Nds::zero()));
    }
}
