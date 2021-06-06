<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%input}}`.
 */
class m210606_093801_create_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%input}}', [
            'id' => $this->primaryKey(),
            'query' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%input}}');
    }
}
