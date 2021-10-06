<?php

class PageCest
{
    public function sitePageWorks(AcceptanceTester $I)
    {
        $I->wantTo('Проверка доступности страниц сайта');
        $pageList = $I->pages();
        foreach ($pageList as $page){
            $I->amOnPage($page['url']);
            $I->canSeeResponseCodeIs(200);
        }
    }
}
