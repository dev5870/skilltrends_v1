<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 */
class m210606_093836_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'input_id' => $this->integer()->notNull(),
            'date' => $this->string()->notNull(),
            'quantity' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%results}}');
    }
}
