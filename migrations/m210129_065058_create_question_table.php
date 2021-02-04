<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m210129_065058_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'name_kaz' => $this->string()->notNull(),
            'name_rus' => $this->string()->notNull(),
            'anketa_id' => $this->integer()->notNull(),
            'q_category_id' => $this->integer(),
            'option_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
