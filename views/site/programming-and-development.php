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

</div>
