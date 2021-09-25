<?php

namespace app\models;

use yii\db\ActiveRecord;

class Results extends ActiveRecord
{
    public static function tableName()
    {
        return '{{results}}';
    }

    /**
     * Возвращает количество (за все время) для заданного input_id.
     * @param $inputId
     * @return array
     */
    public static function getQuantityByInputId($inputId)
    {
        $array = Results::find()->select(['quantity'])->where(['input_id' => $inputId])->all();
        $count = count($array);
        $data = array();
        for ($i = 0; $i < $count; $i++) {
            array_push($data, $array[$i]['quantity']);
        }
        return $data;
    }
}