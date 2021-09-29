<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%monthly_statistics}}`.
 */
class m210929_210846_create_monthly_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%monthly_statistics}}', [
            'id' => $this->primaryKey(),
            'input_id' => $this->integer()->notNull(),
            'date' => $this->string()->notNull(),
            'daily_median_for_last_month' => $this->float()->notNull(),
            'change_per_month' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%monthly_statistics}}');
    }
}
