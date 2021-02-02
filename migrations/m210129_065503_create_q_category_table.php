<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%q_category}}`.
 */
class m210129_065503_create_q_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%q_category}}', [
            'id' => $this->primaryKey(),
            'name_kaz' => $this->string()->notNull(),
            'name_rus' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%q_category}}');
    }
}
