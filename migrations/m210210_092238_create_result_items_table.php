<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%result_items}}`.
 */
class m210210_092238_create_result_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%result_items}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'result_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'answer_custom' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%result_items}}');
    }
}
