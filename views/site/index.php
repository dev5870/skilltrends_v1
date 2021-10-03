<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>СПИСОК ПРОФЕССИЙ:</h2>

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
            <a class="btn btn-lg btn-default" href="data">Data engineer, scientist</a>
            <a class="btn btn-lg btn-default" href="driver">Водитель</a>
            <a class="btn btn-lg btn-default" href="translator">Переводчик</a>
            <a class="btn btn-lg btn-default" href="cashier">Кассир</a>
            <a class="btn btn-lg btn-default" href="cleaning-lady">Уборщица</a>
        </p>

        <h2>СПИСОК СКИЛЛОВ:</h2>

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

    <div class="body-content">
        <div class="row">

            <div class="col-lg-4">
                <h2>О проекте</h2>
                <p>Анализируем спрос на рынке труда (вакансии и профессиональные навыки).</p>
            </div>

            <div class="col-lg-4">
                <h2>Блог</h2>
                <p><a href="https://instagram.com/skilltrends.info" target="_blank">instagram.com/skilltrends.info</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Новости</h2>
                <p><i>2021-10-03</i> Добавлена статистика за месяц.</p>
            </div>

        </div>
    </div>
</div>
