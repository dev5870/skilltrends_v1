<?php

use app\models\Charts;
use app\models\MonthlyStatistics;
use app\models\Results;

/* @var $this yii\web\View */

$this->title = 'Дизайнер. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php
        echo '<h2>Профессия: дизайнер</h2>';
        // выводим график вакансий
        echo Charts::getCharts('designer');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('designer');
        echo MonthlyStatistics::getStatisticsForLastMonth('designer');

        echo '<hr><h2>Данные по навыкам</h2>';
        // выводим графики навыков
        echo Charts::getCharts('Photoshop');
        echo Results::getResultsForChangePerDay('Photoshop');
        echo MonthlyStatistics::getStatisticsForLastMonth('Photoshop');
        echo Charts::getCharts('Figma');
        echo Results::getResultsForChangePerDay('Figma');
        echo MonthlyStatistics::getStatisticsForLastMonth('Figma');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
