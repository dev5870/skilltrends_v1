<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%input}}`.
 */
class m210924_205525_add_number_empty_values_column_to_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('input', 'number_empty_values', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('input', 'number_empty_values');
    }
}
