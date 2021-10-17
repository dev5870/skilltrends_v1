<?php

namespace app\models;

use app\models\Input;
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

    /**
     * Возвращает данные из столбца change_per_day для заданного input_id.
     * @param $input
     * @return string
     */
    public static function getResultsForChangePerDay($array): string
    {
        // определяем способ получения input_id
        // может быть получен через query или professional_area
        if (!empty(Input::getDataByProfessionalArea($array))) {
            $input = Input::getDataByProfessionalArea($array);
        } elseif (!empty(Input::getDataByQuery($array))) {
            $input = Input::getDataByQuery($array);
        }

        $dayChange = Results::find()
            ->asArray()
            ->select(['change_per_day'])
            ->where(['date' => date('Y-m-d'), 'input_id' => $input[0]['id']])
            ->one();
        if (!empty($dayChange)) {
            $json = json_decode($dayChange['change_per_day']);
            if (isset($json->color) && gmp_sign($json->count) == 1) {
                return "Изменение за последний день: <span style=\"color:" . $json->color . "\">+" . $json->count . " (" . $json->percent . "%)</span>; ";
            } elseif (isset($json->color) && gmp_sign($json->count) == -1) {
                return "Изменение за последний день: <span style=\"color:" . $json->color . "\">" . $json->count . " (" . $json->percent . "%)</span>; ";
            }
        }
        return '';
    }

    /**
     * Возвращает связанную запись.
     * @return \yii\db\ActiveQuery
     */
    public function getInput()
    {
        return $this->hasOne(Input::class, ['id' => 'input_id']);
    }
}