<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%header_results}}`.
 */
class m210202_072656_create_header_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%header_results}}', [
            'id' => $this->primaryKey(),
            'header_question_id' => $this->integer()->notNull(),
            'result_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer(),
            'answer_custom' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%header_results}}');
    }
}
