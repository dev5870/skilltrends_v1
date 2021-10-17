<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профессии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="results-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= 'Список изменений за последний день для всех профессий.' ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute'=>'input.description',
                'label' => 'Профессия',
            ],
            [
                'attribute'=>'date',
                'label' => 'Дата',
            ],
            [
                'attribute'=>'quantity',
                'label' => 'Вакансий',
            ],
            [
                'attribute'=>'change_per_day',
                'label' => 'Изменение за день',
                'value' => function ($model) {
                    $json = json_decode($model['change_per_day']);
                    return $json->count;
                },
            ],
        ],
    ]); ?>


</div>
