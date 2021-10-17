<?php

namespace app\models;

use yii\db\ActiveRecord;

class DistributionByDay extends ActiveRecord
{
    public static function tableName()
    {
        return '{{distribution_by_day}}';
    }
}