<?php

use Codeception\Util\Locator;

class RecordCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
    }

    // tests
    public function chooseEmployeeRecord(FunctionalTester $I)
    {
        $I->click('.record');
    }
}
