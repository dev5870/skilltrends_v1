<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Вымирающие профессии. Профессии в зоне риска. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Вымирающие профессии</h1>

        <?php
        $area = array('cleaning_lady', 'cashier', 'translator', 'driver');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where([
                'input_id' => array(56,57,58,59)
        ])->distinct()->all();

//        var_dump($date);die;
        $countInput = count($input);
        $countDate = count($date);

        $categories = array();
        $series = array();

        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }

        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['description'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Количество вакансий'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество вакансий в Москве']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>

    <div class="body-content" style="display: none">

        <div class="row">
            <div class="col-lg-4">
                <h2>Информация</h2>

                <p>
                    *Профессии в зоне риска - это профессии, как принято называть "вымирающие",
                    в которых человеческий труд может быть заменен программной средой полностью либо частично.
                    Мы не утверждаем, а лишь предполагаем и отслеживаем наши предположения.
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
