<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%option_items}}`.
 */
class m210129_070915_create_option_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%option_items}}', [
            'id' => $this->primaryKey(),
            'name_kaz' => $this->string()->notNull(),
            'name_rus' => $this->string()->notNull(),
            'type' => $this->string(),
            'option_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%option_items}}');
    }
}
