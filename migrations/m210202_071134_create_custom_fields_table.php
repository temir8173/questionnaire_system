<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%custom_fields}}`.
 */
class m210202_071134_create_custom_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%custom_fields}}', [
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
        $this->dropTable('{{%custom_fields}}');
    }
}
