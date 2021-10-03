<?php

use app\models\Charts;
use app\models\MonthlyStatistics;
use app\models\Results;

/* @var $this yii\web\View */

$this->title = 'Data engineer, data scientist. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php
        echo '<h2>Профессия: data engineer</h2>';
        // выводим график вакансий
        echo Charts::getCharts('data_engineer');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('data_engineer');
        echo MonthlyStatistics::getStatisticsForLastMonth('data_engineer');

        echo '<h2>Профессия: data scientist</h2>';
        // выводим график вакансий
        echo Charts::getCharts('data_scientist');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('data_scientist');
        echo MonthlyStatistics::getStatisticsForLastMonth('data_scientist');

        echo '<hr><h2>Данные по навыкам</h2>';
        // выводим графики навыков
        echo Charts::getCharts('Data+Science');
        echo Results::getResultsForChangePerDay('Data+Science');
        echo MonthlyStatistics::getStatisticsForLastMonth('Data+Science');
        echo Charts::getCharts('Pytorch');
        echo Results::getResultsForChangePerDay('Pytorch');
        echo MonthlyStatistics::getStatisticsForLastMonth('Pytorch');
        echo Charts::getCharts('MXnet');
        echo Results::getResultsForChangePerDay('MXnet');
        echo MonthlyStatistics::getStatisticsForLastMonth('MXnet');
        echo Charts::getCharts('Tensorflow');
        echo Results::getResultsForChangePerDay('Tensorflow');
        echo MonthlyStatistics::getStatisticsForLastMonth('Tensorflow');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
