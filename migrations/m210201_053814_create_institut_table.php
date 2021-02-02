<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institut}}`.
 */
class m210201_053814_create_institut_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%institut}}', [
            'id' => $this->primaryKey(),
            'name_rus' => $this->string()->notNull(),
            'name_kaz' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%institut}}');
    }
}
