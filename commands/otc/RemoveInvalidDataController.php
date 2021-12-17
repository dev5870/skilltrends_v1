<?php

namespace app\commands\otc;

use yii\console\Controller;
use app\models\Results;

class RemoveInvalidDataController extends Controller
{
    /**
     * Удаляет все ошибочные записи за определенную дату.
     */
    public function actionRun()
    {
        Results::deleteAll(['date' => '2021-12-17']);
    }
}
