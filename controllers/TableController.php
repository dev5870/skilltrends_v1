<?php

namespace app\controllers;

use app\models\Results;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Выводит данные для таблиц со всеми профессиями и скилами.
 */
class TableController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Получает и передает данные для профессий.
     * @return mixed
     */
    public function actionProfession()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Results::find()
                ->asArray()
                ->from('results')
                ->joinWith('input')
                ->where([
                    'input.type' => 'vacancies',
                    'date' => date('Y-m-d')
                ]),
            'sort' => ['attributes' => ['quantity']]
        ]);

        return $this->render('profession', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Получает и передает данные для скиллов.
     * @return mixed
     */
    public function actionSkills()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Results::find()
                ->asArray()
                ->from('results')
                ->joinWith('input')
                ->where([
                    'input.type' => 'skill',
                    'date' => date('Y-m-d')
                ]),
            'sort' => ['attributes' => ['quantity']]
        ]);

        return $this->render('skills', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
