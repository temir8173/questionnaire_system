<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%school}}`.
 */
class m210201_053825_create_school_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'name_rus' => $this->string()->notNull(),
            'name_kaz' => $this->string()->notNull(),
            'institute_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%school}}');
    }
}
