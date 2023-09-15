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
        $admin->setEmail('admin@admin.com');
        $admin->setFirstname('admin');
        $admin->setLastname('ADMIN');
        $adminPassword = $this->passwordHasher->hashPassword($admin, 'password');
        $admin->setPassword($adminPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsSign(0);

        $manager->persist($admin);
        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@user.com');
            $user->setFirstname('User' . $i);
            $user->setLastname('USER' . $i);
            $userPassword = $this->passwordHasher->hashPassword($user, 'password');
            $user->setPassword($userPassword);
            $user->setRoles(['ROLE_USER']);
            $user->setIsSign(0);

            $manager->persist($user);
            $manager->flush();
        }
    }
}
