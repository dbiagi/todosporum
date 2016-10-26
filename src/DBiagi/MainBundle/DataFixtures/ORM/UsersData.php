<?php

namespace DBiagi\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DBiagi\MainBundle\Entity\User;

/**
 * Description of UsersData
 *
 * @author diego
 */
class UsersData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface {

    /** @var ContainerInterface */
    private $container = null;

    /** @var \Faker\Generator */
    private $faker = null;

    const USERS_COUNT = 2;

    public function load(ObjectManager $manager) {
        $this->faker = $this->container->get('faker');

        $this->loadAdmin($manager);
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager) {
        for ($i = 0; $i < static::USERS_COUNT; $i++) {
            $email = $this->faker->email;
            
            $user = new User();
            $user
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setEmail($email)
                ->setUsername($email)
                ->setPlainPassword($this->faker->password)
                ->setEnabled(true)
            ;
            
            $manager->persist($user);
            
            $this->setReference('user-' . $i, $user);
        }

        $manager->flush();
    }

    private function loadAdmin(ObjectManager $manager) {
        $admin = new User();
        $admin->setFirstName('Admin')
            ->setEmail($this->container->getParameter('admin_email'))
            ->setUsername($this->container->getParameter('admin_email'))
            ->setPlainPassword('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setEnabled(true)
        ;

        $manager->persist($admin);
        $manager->flush();

        $this->setReference('admin', $admin);
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getOrder() {
        return 1;
    }

}
