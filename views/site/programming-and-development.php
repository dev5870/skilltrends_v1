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
        echo '<h3>Языки программирования</h3>';
        echo Charts::getCharts('programming_language');
        echo '<h3>Системы контроля версий</h3>';
        echo Charts::getCharts('Git');
        echo Results::getResultsForChangePerDay('Git');
        echo MonthlyStatistics::getStatisticsForLastMonth('Git');
        echo Charts::getCharts('SVN');
        echo Results::getResultsForChangePerDay('SVN');
        echo MonthlyStatistics::getStatisticsForLastMonth('SVN');
        echo Charts::getCharts('vcs');
        echo '<h3>Базы данных</h3>';
        echo Charts::getCharts('db');
        echo '<h3>Системы развертывания</h3>';
        echo Charts::getCharts('deployment');
        echo '<h3>ОС</h3>';
        echo Charts::getCharts('oc');
        echo '<h3>Frontend</h3>';
        echo Charts::getCharts('frontend');
        echo '<h3>Фреймворки (CMF)</h3>';
        echo Charts::getCharts('Yii2');
        echo Results::getResultsForChangePerDay('Yii2');
        echo MonthlyStatistics::getStatisticsForLastMonth('Yii2');
        echo Charts::getCharts('Laravel');
        echo Results::getResultsForChangePerDay('Laravel');
        echo MonthlyStatistics::getStatisticsForLastMonth('Laravel');
        echo Charts::getCharts('Symfony');
        echo Results::getResultsForChangePerDay('Symfony');
        echo MonthlyStatistics::getStatisticsForLastMonth('Symfony');
        echo Charts::getCharts('CodeIgniter');
        echo Results::getResultsForChangePerDay('CodeIgniter');
        echo MonthlyStatistics::getStatisticsForLastMonth('CodeIgniter');
        echo Charts::getCharts('CakePHP');
        echo Results::getResultsForChangePerDay('CakePHP');
        echo MonthlyStatistics::getStatisticsForLastMonth('CakePHP');
        echo Charts::getCharts('Zend+Framework');
        echo Results::getResultsForChangePerDay('Zend+Framework');
        echo MonthlyStatistics::getStatisticsForLastMonth('Zend+Framework');
        echo Charts::getCharts('Phalcon');
        echo Results::getResultsForChangePerDay('Phalcon');
        echo MonthlyStatistics::getStatisticsForLastMonth('Phalcon');
        echo Charts::getCharts('FuelPHP');
        echo Results::getResultsForChangePerDay('FuelPHP');
        echo MonthlyStatistics::getStatisticsForLastMonth('FuelPHP');
        echo '<h3>Движки (CMS)</h3>';
        echo Charts::getCharts('WordPress');
        echo Results::getResultsForChangePerDay('WordPress');
        echo MonthlyStatistics::getStatisticsForLastMonth('WordPress');
        echo Charts::getCharts('Joomla');
        echo Results::getResultsForChangePerDay('Joomla');
        echo MonthlyStatistics::getStatisticsForLastMonth('Joomla');
        echo Charts::getCharts('Drupal');
        echo Results::getResultsForChangePerDay('Drupal');
        echo MonthlyStatistics::getStatisticsForLastMonth('Drupal');
        echo Charts::getCharts('MODX');
        echo Results::getResultsForChangePerDay('MODX');
        echo MonthlyStatistics::getStatisticsForLastMonth('MODX');
        echo Charts::getCharts('OpenCart');
        echo Results::getResultsForChangePerDay('OpenCart');
        echo MonthlyStatistics::getStatisticsForLastMonth('OpenCart');
        echo Charts::getCharts('1c-bitrix');
        echo Results::getResultsForChangePerDay('1c-bitrix');
        echo MonthlyStatistics::getStatisticsForLastMonth('1c-bitrix');
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
