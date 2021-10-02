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
