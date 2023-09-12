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
        $user = new User();
        $user->setEmail('tristanfio05@gmail.com');
        $user->setFirstname('Tristan');
        $user->setLastname('FIORONI');
        $userPassword = $this->passwordHasher->hashPassword($user, 'password'); // Utilisation de hashPassword au lieu de encodePassword
        $user->setPassword($userPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setIsSign(0);

        $manager->persist($user);
        $manager->flush();
    }
}
