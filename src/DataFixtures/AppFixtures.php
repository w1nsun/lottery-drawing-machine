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

        $prize1 = new Prize();
        $prize1
            ->setTitle('IPhone 11')
            ->setType(Prize::TYPE_REAL)
        ;
        $manager->persist($prize1);

        $prize2 = new Prize();
        $prize2
            ->setTitle('100$ - 500$')
            ->setType(Prize::TYPE_MONEY)
            ->setMinSum(100)
            ->setMaxSum(500)
        ;
        $manager->persist($prize2);

        $prize3 = new Prize();
        $prize3
            ->setTitle('600 - 800 bonuses')
            ->setType(Prize::TYPE_BONUSES)
            ->setMinSum(600)
            ->setMaxSum(800)
        ;
        $manager->persist($prize3);

        $manager->flush();
    }
}
