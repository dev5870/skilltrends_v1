<?php

use app\models\Charts;
use app\models\MonthlyStatistics;
use app\models\Results;

/* @var $this yii\web\View */

$this->title = 'Программирование и разработка. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php
        echo '<h2>Профессия: программист/разработчик</h2>';
        // выводим график вакансий
        echo Charts::getCharts('programming_and_development');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('programming_and_development');
        echo MonthlyStatistics::getStatisticsForLastMonth('programming_and_development');

        echo '<hr><h2>Данные по навыкам</h2>';
        // выводим графики навыков
        echo Charts::getCharts('programming_language');
        echo Charts::getCharts('Yii2');
        echo Results::getResultsForChangePerDay('Yii2');
        echo MonthlyStatistics::getStatisticsForLastMonth('Yii2');
        echo Charts::getCharts('Laravel');
        echo Results::getResultsForChangePerDay('Laravel');
        echo MonthlyStatistics::getStatisticsForLastMonth('Laravel');
        echo Charts::getCharts('Symfony');
        echo Results::getResultsForChangePerDay('Symfony');
        echo MonthlyStatistics::getStatisticsForLastMonth('Symfony');
        echo Charts::getCharts('vcs');
        echo Charts::getCharts('db');
        echo Charts::getCharts('deployment');
        echo Charts::getCharts('oc');
        echo Charts::getCharts('frontend');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

    <div class="body-content" style="display: none">

        <div class="row">
            <div class="col-lg-4">
                <h2>Информация</h2>

                <p>
                    Количество упоминаний собираются из открытых вакансий.
                    На текущий момент анализируется город Москва. В следующей версии проекта будет представлен анализ
                    для
                    нескольких крупных городов РФ, а также подключение других стран.
                </p>

                <p><a class="btn btn-default" href="" style="display: none"></a></p>
            </div>
            <div class="col-lg-4">
                <h2>Блог</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Новости</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>
                </p>
            </div>
        </div>

    </div>
</div>
