<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\UserPrize;

final class ActivateResult
{
    private int $status;
    private UserPrize $prize;

    private function __construct(int $status, UserPrize $prize)
    {
        $this->status = $status;
        $this->prize = $prize;
    }

    public static function createSuccess(UserPrize $prize): self
    {
        return new self(1, $prize);
    }

    public static function createFailed(UserPrize $prize): self
    {
        return new self(0, $prize);
    }

    public function isSuccess(): bool
    {
        return $this->status === 1;
    }

    public function getUserPrize(): UserPrize
    {
        return $this->prize;
    }
}
