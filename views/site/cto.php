<?php

use app\models\Charts;
use app\models\MonthlyStatistics;
use app\models\Results;

/* @var $this yii\web\View */

$this->title = 'Технический директор, CTO. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php
        echo '<h2>Профессия: СTO</h2>';
        // выводим график вакансий
        echo Charts::getCharts('cto');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('cto');
        echo MonthlyStatistics::getStatisticsForLastMonth('cto');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
