<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%program}}`.
 */
class m210201_053857_create_program_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%program}}', [
            'id' => $this->primaryKey(),
            'name_rus' => $this->string()->notNull(),
            'name_kaz' => $this->string()->notNull(),
            'school_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%program}}');
    }
}
