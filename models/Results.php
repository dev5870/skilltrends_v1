<?php

namespace app\models;

use yii\db\ActiveRecord;

class Results extends ActiveRecord
{
    public static function tableName()
    {
        return '{{results}}';
    }
}