<?php

namespace App\Tests\Service;

use App\Service\MoneyToBonusesConverter;
use PHPUnit\Framework\TestCase;

class MoneyToBonusesConverterTest extends TestCase
{
    public function testConvertSuccessfully(): void
    {
        $converter = new MoneyToBonusesConverter();
        $result = $converter->convert(100);

        self::assertEquals(10000, $result);
    }

    public function testOverflow(): void
    {
        $converter = new MoneyToBonusesConverter();
        $result = $converter->convert(PHP_INT_MAX);

        self::assertEquals(PHP_INT_MAX - 1, $result);
    }
    public function testWithNegativeExchangeRate(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $converter = new MoneyToBonusesConverter(-100);
        $converter->convert(100);
    }
}
