<?php

class FirstCest
{
    public function test(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->Click(['xpath' => '//div[@id="sw_dropdown_5"]']);
        $I->Click(['xpath' => '//div[@class="ty-account-info__buttons buttons-container"]/a[@class="cm-dialog-opener cm-dialog-auto-size ty-btn ty-btn__secondary"]']);
        $I->fillField(['id' => 'login_main_login'], 'code@test.com');
        $I->fillField(['id' => 'psw_main_login'], 'password');
        $I->click('form[name=main_login_form] button[type=submit]');
        sleep(2);
        // войдет в аккаунт
        $I->Click(['xpath' => '//div[@id="sw_dropdown_5"]/a']);
        $I->Click(['xpath' => '//div[@id="account_info_5"]/ul/li[3]/a']);
        // перейдет на страницу отделов и посмотрит logo, имя отдела и руководителя
        $I->seeElement('//img[@src="http://advanced.project/images/thumbnails/150/150/department/8/img101_0mrt-ox.png"]');
        $I->see('Отдел: First department');
        $I->see('Руководитель: Администратор Главный');
        $I->Click('Отдел: First department');
        // в отделе First department посмотрит сотрудников
        $I->see('Петрова Анна');
        $I->see('Петров Денис');
        // разлогинется
        $I->Click(['xpath' => '//div[@id="sw_dropdown_5"]']);
        $I->Click(['xpath' => '//div[@class="ty-account-info__buttons buttons-container"]/a[@class="ty-btn ty-btn__primary"]']);
        sleep(2);
        $I->Click(['xpath' => '//div[@id="sw_dropdown_5"]']);
        // так как разлогинился то выдаст page not found так как показывает отделы для авторизованных пользователей
        $I->seeLink('Sign in');
        $I->makeHtmlSnapshot();
    }
}