<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Программирование и разработка. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Профессия: программист/разработчик</h2>

        <?php
        $input = Input::getDataByProfessionalArea('programming_and_development');
        $dayChange = Results::find()
            ->asArray()
            ->select(['change_per_day'])
            ->where(['date' => date('Y-m-d'), 'input_id' => $input[0]['id']])
            ->one();
        if (!empty($dayChange)){
            $json = json_decode($dayChange['change_per_day']);
            if (isset($json->color)){
                echo "<h4>Изменение за день: <span style=\"color:" . $json->color . "\">" . $json->count . " (" . $json->percent . "%)</span></h4>";
            }
        }
        ?>

        <?php
        $query = array();
        $area = array('programming_and_development');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
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
                'title' => ['text' => 'Количество вакансий: Программирование и разработка'],
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

        <?php
        $area = array('programming_language');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Разбивка по языкам программирования (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $query = array('Yii2');
        $input = Input::getDataByQuery($query);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Skill: Yii2 (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $query = array('Laravel');
        $input = Input::getDataByQuery($query);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Skill: Laravel (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $query = array('Symfony');
        $input = Input::getDataByQuery($query);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Skill: Symfony (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $query = array('Gitlab', 'Github');
        $input = Input::getDataByQuery($query);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Skill: Gitlab, Github (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $area = array('db');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Разбивка по базам данных (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $area = array('deployment');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Разбивка по системам развертывания проектов (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $area = array('oc');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Разбивка по операционным системам (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
                ],
                'series' => $series
            ]
        ]);
        ?>

        <?php
        $area = array('frontend');
        $input = Input::getDataByProfessionalArea($area);
        $date = Results::find()->asArray()->select(['date'])->where(['input_id' => $input[0]['id']])->distinct()->all();
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['query'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
        }
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Skill: Frontend (Количество упоминаний в вакансиях по Москве)'],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Количество упоминаний']
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
