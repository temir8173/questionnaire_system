<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%header_fields}}`.
 */
class m210202_071115_create_header_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%header_fields}}', [
            'id' => $this->primaryKey(),
            'anketa_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'name_rus' => $this->string()->notNull(),
            'name_kaz' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%header_fields}}');
    }
}
