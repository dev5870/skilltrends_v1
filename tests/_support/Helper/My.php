<?php

namespace Helper;

class My extends \Codeception\Module
{
    public function pages(): array
    {
        return [
            ['url' => '/'],
            ['url' => 'cto'],
            ['url' => 'site-optimization-seo'],
            ['url' => 'programming-and-development'],
            ['url' => 'testing'],
            ['url' => 'technical-writer'],
            ['url' => 'project-management'],
            ['url' => 'analyst'],
            ['url' => 'dentist'],
            ['url' => 'pediatrician'],
            ['url' => 'copywriter'],
            ['url' => 'accountant'],
            ['url' => 'lawyer'],
            ['url' => 'courier'],
            ['url' => 'security'],
            ['url' => 'trainer'],
            ['url' => 'waiter'],
            ['url' => 'psychologist'],
            ['url' => 'biotechnologist'],
            ['url' => 'roboticist'],
            ['url' => 'marketer'],
            ['url' => 'designer'],
            ['url' => 'geneticist'],
            ['url' => 'information-security'],
            ['url' => 'teacher'],
            ['url' => 'data'],
            ['url' => 'driver'],
            ['url' => 'translator'],
            ['url' => 'cashier'],
            ['url' => 'cleaning-lady'],
        ];
    }
}
