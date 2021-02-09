<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ActivateResult;
use App\Entity\UserPrize;

class UserPrizeActivator
{
    public function activate(UserPrize $userPrize): ActivateResult
    {
        //validation or invoke 3d party API
        $userPrize->activate();

        return ActivateResult::createSuccess($userPrize);
    }

    /**
     * @param UserPrize[] $userPrizes
     * @return ActivateResult[]
     */
    public function batchActivate(array $userPrizes): array
    {
        $result = [];

        foreach ($userPrizes as $userPrize) {
            $this->activate($userPrize);
            $result[] = ActivateResult::createSuccess($userPrize);
        }

        return $result;
    }
}
