<?php

namespace app\models;

use yii\db\ActiveRecord;

class Input extends ActiveRecord
{
    public static function tableName()
    {
        return '{{input}}';
    }
}