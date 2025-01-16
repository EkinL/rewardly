<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }



    public const MAX_USERS = 10;

    public function load(ObjectManager $manager): void
    {

    for ($i = 0; $i < self::MAX_USERS; $i++) {
        $user = new User();
        $user->setEmail(email: "test_{$i}@example.com");
        $user->setFullName(fullName: "test_{$i}");
        $hashedpassword = $this->passwordHasher->hashPassword($user, 'motdepasse');
        $user->setPassword($hashedpassword);
        $users[] = $user;

        $manager->persist(object: $user);
    }

    $manager->flush();
    }

}