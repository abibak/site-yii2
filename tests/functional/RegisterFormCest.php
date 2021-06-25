<?php

class RegisterFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('/site/register');
    }

    // tests
    public function userRegisterSuccess(\FunctionalTester $I)  // success register
    {
        $I->fillField('Users[name]', 'test');
        $I->fillField('Users[surname]', 'test');
        $I->fillField('Users[patronymic]', 'test');
        $I->fillField('Users[phone]', 12345);
        $I->fillField('Users[password]', 'test123');

        $I->click('.btn-register');
    }

    public function userFailedRegisterNoName(\FunctionalTester $I)  // fail no name
    {
        $I->fillField('Users[name]', '');
        $I->fillField('Users[surname]', 'test');
        $I->fillField('Users[patronymic]', 'test');
        $I->fillField('Users[phone]', 12345);
        $I->fillField('Users[password]', 'test123');

        $I->click('.btn-register');
        $I->seeInField('Users[name]', '');
    }

    public function userFailedRegisterNoSurname(\FunctionalTester $I)  // fail no surname
    {
        $I->fillField('Users[name]', 'test');
        $I->fillField('Users[surname]', '');
        $I->fillField('Users[patronymic]', 'test');
        $I->fillField('Users[phone]', 12345);
        $I->fillField('Users[password]', 'test123');

        $I->click('.btn-register');
        $I->seeInField('Users[surname]', '');
    }

    public function userFailedRegisterNoPatronymic(\FunctionalTester $I)  // fail no patronymic
    {
        $I->fillField('Users[name]', 'test');
        $I->fillField('Users[surname]', 'test');
        $I->fillField('Users[patronymic]', '');
        $I->fillField('Users[phone]', 12345);
        $I->fillField('Users[password]', 'test123');

        $I->click('.btn-register');
        $I->seeInField('Users[patronymic]', '');
    }

    public function userFailedRegisterNoPhone(\FunctionalTester $I)  // fail no phone
    {
        $I->fillField('Users[name]', 'test');
        $I->fillField('Users[surname]', 'test');
        $I->fillField('Users[patronymic]', 'test');
        $I->fillField('Users[phone]', '');
        $I->fillField('Users[password]', 'test123');

        $I->click('.btn-register');
        $I->seeInField('Users[phone]', '');
    }

    public function userFailedRegisterNoPassword(\FunctionalTester $I)  // fail no password
    {
        $I->fillField('Users[name]', 'test');
        $I->fillField('Users[surname]', 'test');
        $I->fillField('Users[patronymic]', 'test');
        $I->fillField('Users[phone]', 12345);
        $I->fillField('Users[password]', '');

        $I->click('.btn-register');
        $I->seeInField('Users[password]', '');
    }
}
