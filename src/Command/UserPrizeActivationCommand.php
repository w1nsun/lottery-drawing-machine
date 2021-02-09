<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Entity\UserPrize;
use App\Service\UserPrizeActivator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserPrizeActivationCommand extends Command
{
    protected static $defaultName = 'app:user-prize-activation';

    private UserPrizeActivator $activator;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPrizeActivator $activator, EntityManagerInterface $entityManager)
    {
        $this->activator = $activator;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('num', InputArgument::OPTIONAL, 'Number of prizes to activate.', 1)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $num = (int) $input->getArgument('num');
        $username = $input->getArgument('username');

        $user = $this->entityManager->getRepository(User::class)->findBy([
            'username' => $username,
        ]);

        /** @var UserPrize[] $prizes */
        $userPrizes = $this->entityManager->getRepository(UserPrize::class)->findBy(
            [
                'user' => $user,
                'status' => UserPrize::STATUS_NEW,
            ],
            [
                'id' => 'ASC',
            ],
            [
                'limit' => $num,
            ]
        );

        $results = $this->activator->batchActivate($userPrizes);
        $this->entityManager->flush();

        $successNum = 0;
        foreach ($results as $r) {
            $successNum += $r->isSuccess() ? 1 : 0;
        }

        $output->writeln(\sprintf('Successfully activated!. Number of prizes: %d, User: %s', $successNum, $username));

        return Command::SUCCESS;
    }
}
