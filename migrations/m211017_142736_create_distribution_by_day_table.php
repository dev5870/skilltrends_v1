<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%distribution_by_day}}`.
 */
class m211017_142736_create_distribution_by_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%distribution_by_day}}', [
            'id' => $this->primaryKey(),
            'tm_create' => $this->string()->notNull(),
            'data' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%distribution_by_day}}');
    }
}
