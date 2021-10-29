<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Restaurant;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create("fr_FR");

        // City
        for ($i = 1; $i <= 10; $i++) {
            $city = new City();
            $city->setName($faker->city);
            $manager->persist($city);

            for ($j = 0; $j < 20; $j++) {
                // Owner
                $owner = new Owner();
                $owner->setLastname($faker->lastName);
                $owner->setFirstname($faker->firstName);
                $owner->setBirthdate($faker->dateTimeBetween($startDate = '-100 years', $endDate = '-20 years', $timezone = 'Europe/Paris'));
                $manager->persist($owner);

                // Restaurant
                $restaurant = new Restaurant();
                $restaurant->setName($faker->company);
                $restaurant->setAddress($faker->streetAddress);
                $restaurant->setImage("https://picsum.photos/id/{$j}/200/300");
                $restaurant->setCity($city);
                $restaurant->setOwner($owner);

                $manager->persist($restaurant);
            }
        }

        $manager->flush();
    }
}
