<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Тестировщик. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">

        <h2>Профессия: тестировщик ПО</h2>

        <?php
        $query = array();
        $area = array('testing_software');
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
                'title' => ['text' => 'Количество вакансий: Тестировщик ПО'],
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
        // изменение за последний день
        echo Results::getResultsForChangePerDay($input);

        // среднее изменение за последний месяц

        ?>

        <hr>
        <h2>Данные по навыкам</h2>

        <?php
        $query = array('Codeception');
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
                'title' => ['text' => 'Skill: Codeception (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Selenium');
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
                'title' => ['text' => 'Skill: Selenium (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Postman');
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
                'title' => ['text' => 'Skill: Postman (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Soapui');
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
                'title' => ['text' => 'Skill: Soapui (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Soap');
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
                'title' => ['text' => 'Skill: Soap (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Rest');
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
                'title' => ['text' => 'Skill: REST (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Jira');
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
                'title' => ['text' => 'Skill: Jira (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Redmine');
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
                'title' => ['text' => 'Skill: Redmine (Количество упоминаний в вакансиях по Москве)'],
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
        $query = array('Confluence');
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
                'title' => ['text' => 'Skill: Confluence (Количество упоминаний в вакансиях по Москве)'],
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
