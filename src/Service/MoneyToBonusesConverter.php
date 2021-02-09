<?php

declare(strict_types=1);

namespace App\Service;

class MoneyToBonusesConverter
{
    private const DEFAULT_EXCHANGE_RATE = 100;

    private int $exchangeRate;

    public function __construct(int $exchangeRate = self::DEFAULT_EXCHANGE_RATE)
    {
        if ($exchangeRate <= 0 || $exchangeRate === PHP_INT_MAX) {
            throw new \InvalidArgumentException(\sprintf('Exchange rate must be greater than 0 and less than %d.', PHP_INT_MAX));
        }

        $this->exchangeRate = $exchangeRate;
    }

    public function convert(int $money): int
    {
        $result = $money * $this->exchangeRate;

        if (!\is_int($result)) {
            return PHP_INT_MAX - 1;
        }

        return $result;
    }
}
