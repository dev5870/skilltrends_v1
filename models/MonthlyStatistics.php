<?php

namespace app\models;

use yii\db\ActiveRecord;

class MonthlyStatistics extends ActiveRecord
{
    public static function tableName()
    {
        return '{{monthly_statistics}}';
    }
}