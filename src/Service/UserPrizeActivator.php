<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\UserPrize;
use Doctrine\ORM\EntityManagerInterface;

class UserPrizeActivator
{
    public function activate(UserPrize $userPrize): bool
    {
        //validation or invoke 3d party API

        $userPrize->activate();

        return true;
    }

    /**
     * @param UserPrize[] $userPrizes
     * @return bool[]
     */
    public function batchActivate(array $userPrizes): array
    {
        $statuses = [];

        foreach ($userPrizes as $userPrize) {
            $statuses[$userPrize->getId()] = $this->activate($userPrize);
        }

        return $statuses;
    }
}
