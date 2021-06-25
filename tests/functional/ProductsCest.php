<?php

class ProductsCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('/site/products');
    }
}
