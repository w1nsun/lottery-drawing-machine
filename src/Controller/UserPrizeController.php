<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Prize;
use App\Entity\User;
use App\Entity\UserPrize;
use App\Service\LotteryDrawingMachine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPrizeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private LotteryDrawingMachine $lotteryDrawingMachine;

    public function __construct(EntityManagerInterface $entityManager, LotteryDrawingMachine $lotteryDrawingMachine)
    {
        $this->entityManager = $entityManager;
        $this->lotteryDrawingMachine =$lotteryDrawingMachine;
    }

    /**
     * @Route("/prizes", name="app_user_prizes")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted(User::ROLE_USER);
        /** @var User $user */
        $user = $this->getUser();

        /** @var UserPrize[] $prizes */
        $userPrizes = $this->entityManager->getRepository(UserPrize::class)->findBy([
            'user' => $user
        ]);

        return $this->render('UserPrize/index.html.twig', [
            'userPrizes' => $userPrizes,
        ]);
    }

    /**
     * @Route("/api/prizes/get-random.json", name="api_get_random_prize", methods={"POST","GET"})
     */
    public function getRandomPrize(): JsonResponse
    {
        $this->denyAccessUnlessGranted(User::ROLE_USER);

        $prize = $this->lotteryDrawingMachine->pickPrize();

        /** @var User $user */
        $user = $this->getUser();
        $userPrize = new UserPrize($user, $prize);
        $this->entityManager->persist($userPrize);
        $this->entityManager->flush();

        return $this->json([
            'success' => true,
            'data' => [
                'title' => $prize->getTitle(),
                'readableType' => $prize->getReadableType(),
            ],
        ]);
    }
}
