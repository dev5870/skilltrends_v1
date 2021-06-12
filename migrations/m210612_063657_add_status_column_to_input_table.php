<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%input}}`.
 */
class m210612_063657_add_status_column_to_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('input', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('input', 'status');
    }
}
