<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    /** @var UserPasswordHasherInterface */
    private $userPasswordHasherInterface;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // create admin user
        $adminUser = (new User())
            ->setLastname('AKREMI')
            ->setFirstname('Chaima')
            ->setUsername('chaima.akremi.1997@gmail.com')
            ->setActive(true)
            ->setRoles(User::ROLE_ADMINISTRATOR);
        $adminUser->setPassword($this->userPasswordHasherInterface->hashPassword($adminUser, hash('sha256', 'myPassword')));

        // create employee user
        $employeeUser = (new User())
            ->setLastname('AKREMI')
            ->setFirstname('Chaima')
            ->setUsername('chaima.akremi@gmail.com')
            ->setActive(true)
            ->setRoles(User::ROLE_EMPLOYEE);
        $employeeUser->setPassword($this->userPasswordHasherInterface->hashPassword($employeeUser, hash('sha256', 'myPassword')));

        $manager->persist($adminUser);
        $manager->persist($employeeUser);

        $manager->flush();
    }
}
