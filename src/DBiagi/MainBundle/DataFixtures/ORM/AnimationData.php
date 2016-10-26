<?php

namespace DBiagi\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DBiagi\MainBundle\Entity\User;
use DBiagi\MainBundle\Entity\Animation;

/**
 * Description of UsersData
 *
 * @author diego
 */
class AnimationData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface {

    /** @var ContainerInterface */
    private $container = null;

    /** @var \Faker\Generator */
    private $faker = null;

    const COUNT = 2;

    public function load(ObjectManager $manager) {
        /* @var $faker \Faker\Generator */
        $faker = $this->container->get('faker');

        for ($i = 0; $i < AnimationData::COUNT; $i++) {
            $a = new Animation();
            $author = $this->getReference('user-' . rand(1, UsersData::USERS_COUNT - 1));
            $a
                ->setTitle($faker->title)
                ->setAuthor($author)
            ;
            
            $manager->persist($a);
        }
        
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getOrder() {
        return 2;
    }

}
