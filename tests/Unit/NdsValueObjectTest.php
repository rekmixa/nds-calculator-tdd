<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\ValueObjects\Exceptions\NdsCannotBeMoreThanTwenty;
use App\ValueObjects\Exceptions\NdsCannotBeNegative;
use App\ValueObjects\Nds;
use PHPUnit\Framework\TestCase;

final class NdsValueObjectTest extends TestCase
{
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

    public function testCreateWithTooLargeValue(): void
    {
        self::expectException(NdsCannotBeMoreThanTwenty::class);

        Nds::fromInt(21);
    }
}
