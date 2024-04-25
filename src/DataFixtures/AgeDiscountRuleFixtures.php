<?php

namespace App\DataFixtures;

use App\Entity\AgeDiscountRule;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AgeDiscountRuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ageDiscountRule = new AgeDiscountRule();
        $ageDiscountRule->setMinAgeLimit(3);
        $ageDiscountRule->setMaxAgeLimit(6);
        $ageDiscountRule->setAmountLimit(0);
        $ageDiscountRule->setModifier(0.8);
        $ageDiscountRule->setActive(true);
        $manager->persist($ageDiscountRule);

        $ageDiscountRule = new AgeDiscountRule();
        $ageDiscountRule->setMinAgeLimit(6);
        $ageDiscountRule->setMaxAgeLimit(12);
        $ageDiscountRule->setAmountLimit(4500);
        $ageDiscountRule->setModifier(0.3);
        $ageDiscountRule->setActive(true);
        $manager->persist($ageDiscountRule);

        $ageDiscountRule = new AgeDiscountRule();
        $ageDiscountRule->setMinAgeLimit(12);
        $ageDiscountRule->setMaxAgeLimit(18);
        $ageDiscountRule->setAmountLimit(0);
        $ageDiscountRule->setModifier(0.1);
        $ageDiscountRule->setActive(true);
        $manager->persist($ageDiscountRule);

        $manager->flush();
    }
}
