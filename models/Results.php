<?php

namespace app\models;

use yii\db\ActiveRecord;

class Results extends ActiveRecord
{
    public static function tableName()
    {
        return '{{results}}';
    }

    public static function getAllData()
    {
        return Results::find()->asArray()->select(['input_id', 'date', 'quantity'])->distinct()->all();
    }

    public static function getQuantityByInputId($inputId)
    {
        $array = Results::find()->select(['quantity'])->where(['input_id' => $inputId])->all();
        $count = count($array);
        $data = array();
        for ($i = 0; $i < $count; $i++)
        {
            array_push($data, $array[$i]['quantity']);
        }
        return $data;
    }
}