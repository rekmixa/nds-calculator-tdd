<?php

declare(strict_types=1);

namespace App\ValueObjects;

final class Amount
{
    private float $value;

    public function __construct(float $value)
    {
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
        return self::fromFloat($this->value * $amount->value);
    }

    public function divide(self $amount): self
    {
        return self::fromFloat($this->value / $amount->value);
    }

    public function invertSign(): self
    {
        return self::fromFloat($this->value * -1);
    }

    public function normalize(): self
    {
        return self::fromFloat((float)number_format($this->value, 2));
    }

    public function equals(self $amount): bool
    {
        return $this->value === $amount->value;
    }
}
