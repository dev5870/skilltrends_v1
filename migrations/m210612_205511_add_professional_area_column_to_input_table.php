<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%input}}`.
 */
class m210612_205511_add_professional_area_column_to_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('input', 'professional_area', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('input', 'professional_area');
    }
}
