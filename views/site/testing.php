<?php

use app\models\Charts;
use app\models\MonthlyStatistics;
use app\models\Results;

/* @var $this yii\web\View */

$this->title = 'Тестировщик. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php

        echo '<h2>Профессия: тестировщик ПО</h2>';
        // выводим график вакансий
        echo Charts::getCharts('testing_software');
        // изменение вакансий за последний день и дневная медиана вакансий за прошлый месяц
        echo Results::getResultsForChangePerDay('testing_software');
        echo MonthlyStatistics::getStatisticsForLastMonth('testing_software');

        echo '<hr><h2>Данные по навыкам</h2>';
        // выводим графики навыков
        echo Charts::getCharts('Codeception');
        echo Results::getResultsForChangePerDay('Codeception');
        echo MonthlyStatistics::getStatisticsForLastMonth('Codeception');
        echo Charts::getCharts('Selenium');
        echo Results::getResultsForChangePerDay('Selenium');
        echo MonthlyStatistics::getStatisticsForLastMonth('Selenium');
        echo Charts::getCharts('Postman');
        echo Results::getResultsForChangePerDay('Postman');
        echo MonthlyStatistics::getStatisticsForLastMonth('Postman');
        echo Charts::getCharts('Soapui');
        echo Results::getResultsForChangePerDay('Soapui');
        echo MonthlyStatistics::getStatisticsForLastMonth('Soapui');
        echo Charts::getCharts('Soap');
        echo Results::getResultsForChangePerDay('Soap');
        echo MonthlyStatistics::getStatisticsForLastMonth('Soap');
        echo Charts::getCharts('Rest');
        echo Results::getResultsForChangePerDay('Rest');
        echo MonthlyStatistics::getStatisticsForLastMonth('Rest');
        echo Charts::getCharts('Jira');
        echo Results::getResultsForChangePerDay('Jira');
        echo MonthlyStatistics::getStatisticsForLastMonth('Jira');
        echo Charts::getCharts('Redmine');
        echo Results::getResultsForChangePerDay('Redmine');
        echo MonthlyStatistics::getStatisticsForLastMonth('Redmine');
        echo Charts::getCharts('Confluence');
        echo Results::getResultsForChangePerDay('Confluence');
        echo MonthlyStatistics::getStatisticsForLastMonth('Confluence');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
