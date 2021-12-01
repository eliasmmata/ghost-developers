<?php

namespace App\DataFixtures;

use App\Entity\Secret;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->loadSecret($manager);
        $this->loadUsers($manager);
    }
    public function loadSecret(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) { 
            $secret = new Secret();
            $secret->setText(text:'orem fistrum te voy a borrar el cerito ullamco apetecan quis aliquip magna adipisicing minim enim ' . rand(0, 100));
            $secret->setTime(new \DateTime(datetime:'2021-11-30'));
            $manager->persist($secret);
        }
        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setAlias('willybimen');
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456' ));
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);

        $manager->flush();
    }
}
