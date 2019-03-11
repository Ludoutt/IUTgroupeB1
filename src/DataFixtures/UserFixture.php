<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(6, 'developer_users', function($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('developer%d@domain.tld', $i))
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setRoles(['ROLE_DEVELOPER'])
            ;

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));

            return $user;
        });

        $this->createMany(1, 'product_owner_users', function($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('product-owner%d@domain.tld', $i))
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setRoles(['ROLE_PRODUCT_OWNER'])
            ;

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));

            return $user;
        });

        $this->createMany(1, 'scrum_master_users', function($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('scrum-master%d@domain.tld', $i))
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setRoles(['ROLE_SCRUM_MASTER'])
            ;

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));

            return $user;
        });

        $manager->flush();
    }
}
