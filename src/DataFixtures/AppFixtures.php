<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Prize;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('test1')
            ->setPassword($this->encoder->encodePassword($user, 'pass'))
        ;
        $manager->persist($user);

        $prize = new Prize();
        $prize
            ->setTitle('IPhone 11')
            ->setType(Prize::TYPE_REAL)
        ;

        $prize = new Prize();
        $prize
            ->setTitle('100$ - 500$')
            ->setType(Prize::TYPE_MONEY)
            ->setMinSum(100)
            ->setMaxSum(500)
        ;
        $prize = new Prize();
        $prize
            ->setTitle('600 - 800 bonuses')
            ->setType(Prize::TYPE_BONUSES)
            ->setMinSum(600)
            ->setMaxSum(800)
        ;

        $manager->flush();
    }
}
