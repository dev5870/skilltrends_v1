<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%input}}`.
 */
class m210619_201900_add_description_column_to_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('input', 'description', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('input', 'description');
    }
}
