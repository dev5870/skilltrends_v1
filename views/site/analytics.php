<?php

use app\models\Charts;

/* @var $this yii\web\View */

$this->title = 'Распределение количества вакансий по дням недели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="jumbotron">

        <?php
        echo '<h2>Количество вакансий по дням недели</h2>';
        echo Charts::getPieCharts();
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

</div>
