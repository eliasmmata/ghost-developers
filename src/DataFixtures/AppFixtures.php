<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) { 
            $post = new Post();
            $post->setText(text:'orem fistrum te voy a borrar el cerito ullamco apetecan quis aliquip magna adipisicing minim enim ' . rand(0, 100));
            $post->setTime(new \DateTime(datetime:'2021-11-30'));
            $manager->persist($post);
        }
        $manager->flush();
    }
}
