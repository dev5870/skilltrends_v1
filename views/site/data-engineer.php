<?php

use app\models\Results;
use app\models\Input;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Data engineer. Skill trends - следим за трендами профессиональных навыков';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Профессия: Data engineer</h2>

        <?php
        $query = array();
        $area = array('data_engineer');
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
                'title' => ['text' => 'Количество вакансий: Data engineer'],
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
        $input = Input::getDataByProfessionalArea('data_engineer');
        $dayChange = Results::find()
            ->asArray()
            ->select(['change_per_day'])
            ->where(['date' => date('Y-m-d'), 'input_id' => $input[0]['id']])
            ->one();
        if (!empty($dayChange)){
            $json = json_decode($dayChange['change_per_day']);
            if (isset($json->color)){
                echo "Изменение за последний день: <span style=\"color:" . $json->color . "\">" . $json->count . " (" . $json->percent . "%)</span>; ";
            }
        }

        // среднее медианное изменение
        $allResultsChangePerDay = Results::find()
            ->asArray()
            ->select(['change_per_day'])
            ->where(['input_id' => $input[0]['id']])
            ->all();
        for ($i = 0; $i < count($allResultsChangePerDay); $i++){
            $jsonDecode = json_decode($allResultsChangePerDay[$i]['change_per_day']);
            if(!empty($jsonDecode->count)){
                $count[$i] = $jsonDecode->count;
            }
            if(!empty($jsonDecode->percent)){
                $percent[$i] = $jsonDecode->percent;
            }
        }
        $medianCount = Results::median($count);
        $medianPercent = Results::median($percent);
        if (gmp_sign($medianCount) == 1){
            echo "Дневная медиана (по данным за все время): <span style=\"color:green\">" . $medianCount . " (" . $medianPercent . "%)</span>";
        } elseif (gmp_sign($medianCount) == -1){
            echo "Дневная медиана (по данным за все время): <span style=\"color:red\">" . $medianCount . " (" . $medianPercent . "%)</span>";
        }
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
