<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 */
class m210209_064921_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'language' => $this->string()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'answer_custom' => $this->string(),
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
