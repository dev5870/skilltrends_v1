<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%input}}`.
 */
class m210612_211433_add_tag_column_to_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('input', 'tag', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('input', 'tag');
    }
}
