<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\ValueObjects\Exceptions\NdsCannotBeMoreThanTwenty;
use App\ValueObjects\Exceptions\NdsCannotBeNegative;

final class Nds
{
    private int $value;

    private function __construct(int $value)
    {
        if ($value < 0) {
            throw new NdsCannotBeNegative();
        }

        if ($value > 20) {
            throw new NdsCannotBeMoreThanTwenty();
        }

        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public static function zero(): self
    {
        return self::fromInt(0);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function equals(self $nds): bool
    {
        return $this->value === $nds->value;
    }
}
