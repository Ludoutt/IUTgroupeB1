<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\DataFixtures;

use App\Entity\Acceptation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AcceptationFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(30, 'acceptations_', function ($i) use ($manager) {
            $backlog = new Acceptation();
            $backlog->setName(sprintf('acceptation %d', $i))
                ->setDescription($this->faker->text)
                ->setBacklog($this->getRandomReference('backlogs_'));

            return $backlog;
        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BacklogFixture::class,
        ];
    }
}
