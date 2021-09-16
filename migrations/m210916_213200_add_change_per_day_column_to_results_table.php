<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%results}}`.
 */
class m210916_213200_add_change_per_day_column_to_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('results', 'change_per_day', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('results', 'change_per_day');
    }
}
