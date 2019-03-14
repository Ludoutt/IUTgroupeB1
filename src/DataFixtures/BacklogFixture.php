<?php

namespace App\DataFixtures;

use App\Entity\Backlog;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BacklogFixture extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(11, 'backlogs_', function ($i) use ($manager) {
            $backlog = new Backlog();
            $backlog->setName(sprintf('backlog %d', $i))
                ->setDescription($this->faker->text)
                ->setType($this->faker->randomElement(['epic', 'user_story', 'functionality', 'bug', 'technical_task']));

            return $backlog;
        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
        );
    }
}
