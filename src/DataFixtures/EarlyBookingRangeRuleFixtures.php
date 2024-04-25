<?php

namespace App\DataFixtures;

use App\Entity\EarlyBookingRangeRule;
use Doctrine\Persistence\ObjectManager;
use App\Entity\EarlyBookingDiscountRule;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EarlyBookingRangeRuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $earlyBookingRangeRule = new EarlyBookingRangeRule();
        $earlyBookingRangeRule->setBookingDateFrom('04-01');
        $earlyBookingRangeRule->setIsBookingYearFromNext(true);
        $earlyBookingRangeRule->setBookingDateTo('09-30');
        $manager->persist($earlyBookingRangeRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('');
        $earlyBookingDiscountRule->setPaymentDateTo('11-30');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.07);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('01-01');
        $earlyBookingDiscountRule->setPaymentDateTo('01-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.03);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('12-01');
        $earlyBookingDiscountRule->setPaymentDateTo('12-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.05);
        $manager->persist($earlyBookingDiscountRule);


        $earlyBookingRangeRule = new EarlyBookingRangeRule();
        $earlyBookingRangeRule->setBookingDateFrom('01-15');
        $earlyBookingRangeRule->setIsBookingYearFromNext(true);
        $earlyBookingRangeRule->setBookingDateTo('');
        $manager->persist($earlyBookingRangeRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('');
        $earlyBookingDiscountRule->setPaymentDateTo('08-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.07);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('09-01');
        $earlyBookingDiscountRule->setPaymentDateTo('09-30');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.05);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('10-01');
        $earlyBookingDiscountRule->setPaymentDateTo('10-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.03);
        $manager->persist($earlyBookingDiscountRule);


        $earlyBookingRangeRule = new EarlyBookingRangeRule();
        $earlyBookingRangeRule->setBookingDateFrom('10-01');
        $earlyBookingRangeRule->setIsBookingYearFromNext(false);
        $earlyBookingRangeRule->setBookingDateTo('01-14');
        $manager->persist($earlyBookingRangeRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('');
        $earlyBookingDiscountRule->setPaymentDateTo('03-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.07);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('04-01');
        $earlyBookingDiscountRule->setPaymentDateTo('04-30');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.05);
        $manager->persist($earlyBookingDiscountRule);

        $earlyBookingDiscountRule = new EarlyBookingDiscountRule();
        $earlyBookingDiscountRule->setEarlyBookingRangeRule($earlyBookingRangeRule);
        $earlyBookingDiscountRule->setPaymentDateFrom('05-01');
        $earlyBookingDiscountRule->setPaymentDateTo('05-31');
        $earlyBookingDiscountRule->setAmountLimit(1500);
        $earlyBookingDiscountRule->setModifier(0.03);
        $manager->persist($earlyBookingDiscountRule);

        $manager->flush();
    }
}
