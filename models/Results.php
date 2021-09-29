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
    public static function getQuantityByInputId($inputId): array
    {
        $array = Results::find()->select(['quantity'])->where(['input_id' => $inputId])->all();
        $count = count($array);
        $data = array();
        for ($i = 0; $i < $count; $i++) {
            array_push($data, $array[$i]['quantity']);
        }
        return $data;
    }

    /**
     * Возвращает результаты парсинга для указанного input_id за выбранный интервал дат.
     * @param $inputId
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function getQuantityByInputIdAndDateInterval($inputId, $startDate, $endDate): array
    {
        $array = Results::find()
            ->asArray()
            ->select(['quantity'])
            ->where(['input_id' => $inputId])
            ->andWhere(['between', 'date', $startDate, $endDate])
            ->all();
        $count = count($array);
        $data = array();
        for ($i = 0; $i < $count; $i++) {
            array_push($data, $array[$i]['quantity']);
        }
        return $data;
    }
}