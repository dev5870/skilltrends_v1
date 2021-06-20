<?php

namespace app\models;

use yii\db\ActiveRecord;

class Input extends ActiveRecord
{
    public static function tableName()
    {
        return '{{input}}';
    }

    public static function getAllActiveSkills()
    {
        return Input::find()->asArray()->select([
            'query',
            'id',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'type' => 'skill',
            'status' => 1
        ])->distinct()->all();
    }

    public static function getAllActiveVacancies()
    {
        return Input::find()->asArray()->select([
            'query',
            'id',
            'tag',
            'professional_area',
            'region'
        ])->where([
            'type' => 'vacancies',
            'status' => 1
        ])->distinct()->all();
    }

    public static function getDataByQuery($query)
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

    public static function getDataByProfessionalArea($area)
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
}