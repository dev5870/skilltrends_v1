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
        return Input::find()->asArray()->select(['query', 'id', 'region'])->where(['type' => 'skill', 'status' => 1])->distinct()->all();
    }
}