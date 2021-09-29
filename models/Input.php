<?php

namespace app\models;

use yii\db\ActiveRecord;

class Input extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function tableName()
    {
        return '{{input}}';
    }

    /**
     * Возвращает список всех активных скиллов.
     * @return array
     */
    public static function getAllActiveSkills(): array
    {
        return Input::find()->asArray()->select([
            'query',
            'id',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'type' => 'skill',
            'status' => self::STATUS_ACTIVE
        ])->distinct()->all();
    }

    /**
     * Возвращает список всех активных вакансий.
     * @return array
     */
    public static function getAllActiveVacancies(): array
    {
        return Input::find()->asArray()->select([
            'query',
            'id',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'type' => 'vacancies',
            'status' => self::STATUS_ACTIVE
        ])->distinct()->all();
    }

    /**
     * Возвращает данные для input по значению query.
     * @param $query
     * @return array
     */
    public static function getDataByQuery($query): array
    {
        return Input::find()->asArray()->select([
            'id',
            'description',
            'query',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'query' => $query
        ])->distinct()->all();
    }

    /**
     * Возвращает данные для input по значению professional_area.
     * @param $area
     * @return array
     */
    public static function getDataByProfessionalArea($area): array
    {
        return Input::find()->asArray()->select([
            'id',
            'description',
            'query',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'professional_area' => $area
        ])->distinct()->all();
    }

    /**
     * Возвращает данные для input по id.
     * @param $id
     * @return array
     */
    public static function getDataByInputId($id): array
    {
        return Input::find()->asArray()->select([
            'id',
            'description',
            'type',
            'status',
            'query',
            'tag',
            'professional_area',
            'region',
            'number_empty_values'
        ])->where([
            'id' => $id
        ])->distinct()->all();
    }

    /**
     * Возвращает список всех активных input_id.
     * @return array
     */
    public static function getAllActiveInput(): array
    {
        return Input::find()->asArray()->select([
            'id',
            'description',
            'type',
            'status',
            'query',
            'tag',
            'professional_area',
            'region',
            'number_empty_values'
        ])->where([
            'status' => self::STATUS_ACTIVE
        ])->distinct()->all();
    }
}