<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Prize;
use Doctrine\ORM\EntityManagerInterface;

class LotteryDrawingMachine
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function pickPrize(): Prize
    {
        $prizes = $this->entityManager->getRepository(Prize::class)->findAll();
        $key = array_rand($prizes);

        return $prizes[$key];
    }
}
