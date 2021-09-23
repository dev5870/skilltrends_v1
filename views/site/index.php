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
            <a class="btn btn-xs btn-default" href="cto">CTO (технический директор в IT)</a>
            <a class="btn btn-sm btn-default" href="programming-and-development">Программист/разработчик</a>
            <a class="btn btn-lg btn-default" href="testing">Тестировщик</a>
            <a class="btn btn-lg btn-default" href="technical-writer">Технический писатель</a>
            <a class="btn btn-lg btn-default" href="project-management">Менеджер проектов</a>
            <a class="btn btn-lg btn-default" href="analyst">Бизнес-аналитик</a>
            <a class="btn btn-lg btn-default" href="site-optimization-seo">SEO оптимизатор</a>
            <a class="btn btn-lg btn-default" href="dentist">Стоматолог</a>
            <a class="btn btn-lg btn-default" href="pediatrician">Педиатр</a>
            <a class="btn btn-lg btn-default" href="copywriter">Копирайтер</a>
            <a class="btn btn-lg btn-default" href="accountant">Бухгалтер</a>
            <a class="btn btn-lg btn-default" href="lawyer">Юрист</a>
            <a class="btn btn-lg btn-default" href="courier">Курьер</a>
            <a class="btn btn-lg btn-default" href="security">Охранник</a>
            <a class="btn btn-lg btn-default" href="trainer">Тренер</a>
            <a class="btn btn-lg btn-default" href="waiter">Официант</a>
            <a class="btn btn-lg btn-default" href="psychologist">Психолог</a>
            <a class="btn btn-lg btn-default" href="biotechnologist">Биотехнолог</a>
            <a class="btn btn-lg btn-default" href="roboticist">Робототехник</a>
            <a class="btn btn-lg btn-default" href="marketer">Маркетолог</a>
            <a class="btn btn-lg btn-default" href="designer">Дизайнер</a>
            <a class="btn btn-lg btn-default" href="geneticist">Генетик</a>
            <a class="btn btn-lg btn-default" href="information-security">Информационная безопасность</a>
            <a class="btn btn-lg btn-default" href="teacher">Учитель</a>
            <a class="btn btn-lg btn-default" href="data-engineer">Data engineer</a>
            <a class="btn btn-lg btn-default" href="data-scientist">Data scientist</a>
            <a class="btn btn-lg btn-default" href="driver">Водитель</a>
            <a class="btn btn-lg btn-default" href="translator">Переводчик</a>
            <a class="btn btn-lg btn-default" href="cashier">Кассир</a>
            <a class="btn btn-lg btn-default" href="cleaning-lady">Уборщица</a>
        </p>

        <h1>Список скиллов:</h1>

        <p>
            <a class="btn btn-xs btn-default" href="testing">Codeception</a>
            <a class="btn btn-xs btn-default" href="testing">Selenium</a>
            <a class="btn btn-xs btn-default" href="testing">Postman</a>
            <a class="btn btn-xs btn-default" href="testing">Soapui</a>
            <a class="btn btn-xs btn-default" href="testing">Confluence</a>
            <a class="btn btn-xs btn-default" href="testing">Redmine</a>
            <a class="btn btn-xs btn-default" href="testing">Jira</a>
            <a class="btn btn-xs btn-default" href="testing">Rest</a>
            <a class="btn btn-xs btn-default" href="testing">Soap</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">PHP</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Ruby</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Java</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Kotlin</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Golang</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Swift</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Delphi</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Python</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">JavaScript</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">Typescript</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">C++</a>
            <a class="btn btn-xs btn-default" href="programming-and-development">C#</a>
        </p>
    </div>

    <div class="body-content" style="display: none">

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
