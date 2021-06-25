<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
    }

    public function useLoginSuccess(\FunctionalTester $I)  // success login
    {
        $I->fillField('LoginForm[phone]', '79969349264');
        $I->fillField('LoginForm[password]', 'admin');
        $I->click('.btn-login');
        $I->seeInField('LoginForm[phone]', '79969349264');
        $I->seeInField('LoginForm[password]', 'admin');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
    }

    public function userFailedLoginNoPhone(\FunctionalTester $I)  // login with no phone
    {
        $I->fillField('LoginForm[phone]', '');
        $I->fillField('LoginForm[password]', 'admin');
        $I->click('.btn-login');
        $I->seeInField('LoginForm[phone]', '');
    }

    public function userFailedLoginNoPassword(\FunctionalTester $I)  // login with no password
    {
        $I->fillField('LoginForm[phone]', 79969349264);
        $I->fillField('LoginForm[password]', '');
        $I->click('.btn-login');
        $I->seeInField('LoginForm[password]', '');
    }
}