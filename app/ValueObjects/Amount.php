<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\ValueObjects\Exceptions\AmountCannotBeNegative;

final class Amount
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new AmountCannotBeNegative();
        }

        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self((float)$value);
    }

    public static function fromFloat(float $value): self
    {
        return new self($value);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function add(self $amount): self
    {
        return self::fromFloat($this->value + $amount->value);
    }

    public function subtract(self $amount): self
    {
        return self::fromFloat($this->value - $amount->value);
    }

    public function multiply(self $amount): self
    {
        $result = $this->value * $amount->value;
        $result = (float)number_format($result, 2);

        return self::fromFloat($result);
    }

    public function equals(self $amount): bool
    {
        return $this->value === $amount->value;
    }
}
