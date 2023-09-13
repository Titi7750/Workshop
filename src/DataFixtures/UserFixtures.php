<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('tristanfio05@gmail.com');
        $admin->setFirstname('Tristan');
        $admin->setLastname('FIORONI');
        $adminPassword = $this->passwordHasher->hashPassword($admin, 'password');
        $admin->setPassword($adminPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsSign(0);

        $manager->persist($admin);
        $manager->flush();

        $user = new User();
        $user->setEmail('test@test.com');
        $user->setFirstname('Test');
        $user->setLastname('TEST');
        $userPassword = $this->passwordHasher->hashPassword($user, 'password');
        $user->setPassword($userPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setIsSign(0);

        $manager->persist($user);
        $manager->flush();
    }
}
