<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Список профессий:</h1>

<!--        --><?php
//        $input = Input::getAllActiveSkills();
//        $results = Results::getAllData();
//        $date = Results::find()->asArray()->select(['date'])->distinct()->all();
//        $countDate = count($date);
//        $categories = array();
//
//        for ($i = 0; $i < $countDate; $i++)
//        {
//            array_push($categories, $date[$i]['date']);
//        }
//
//        $countSkills = count($input);
//        $series = array();
//
//        for ($i = 0; $i < $countSkills; $i++)
//        {
//            array_push($series, [
//                'name' => $input[$i]['query'],
//                'data' => Results::getQuantityByInputId($input[$i]['id'])
//            ]);
//        }
//
//        echo Highcharts::widget([
//            'options' => [
//                'title' => ['text' => 'Тренд IT навыков для тестировщиков'],
//                'xAxis' => [
//                    'categories' => $categories
//                ],
//                'yAxis' => [
//                    'title' => ['text' => 'Количество упоминаний']
//                ],
//                'series' => $series
//            ]
//        ]);
//        ?>

        <p class="lead"></p>

        <p>
            <a class="btn btn-xs btn-default" href="cto">Профессия: CTO (технический директор в IT)</a>
            <a class="btn btn-sm btn-default" href="programming-and-development">Профессия: программист/разработчик</a>
            <a class="btn btn-lg btn-default" href="testing">Профессия: тестировщик</a>
            <a class="btn btn-lg btn-default" href="technical-writer">Профессия: технический писатель</a>
            <a class="btn btn-lg btn-default" href="project-management">Профессия: менеджер проектов</a>
            <a class="btn btn-lg btn-default" href="analyst">Профессия: бизнес-аналитик</a>
            <a class="btn btn-lg btn-default" href="site-optimization-seo">Профессия: SEO оптимизатор</a>
            <a class="btn btn-lg btn-default" href="dying-professions">Профессии в зоне риска</a>
        </p>

        <h1>Список скиллов:</h1>

        <p>
            <a class="btn btn-xs btn-default" href="testing">Навык: Codeception</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Selenium</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Postman</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Soapui</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Confluence</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Redmine</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Jira</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Rest</a>
            <a class="btn btn-xs btn-default" href="testing">Навык: Soap</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: PHP</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Ruby</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Java</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Kotlin</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Golang</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Swift</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Delphi</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Python</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: JavaScript</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: Typescript</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: C++</a>
            <a class="btn btn-xs btn-default" href="programming_and_development">Навык: C#</a>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Информация</h2>

                <p>
                    Количество упоминаний собираются из открытых вакансий.
                    На текущий момент анализируется город Москва. В следующей версии проекта будет представлен анализ для
                    нескольких крупных городов РФ, а также подключение других стран.
                </p>

                <p><a class="btn btn-default" href="" style="display: none"></a></p>
            </div>
            <div class="col-lg-4">
                <h2>Блог</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Новости</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
