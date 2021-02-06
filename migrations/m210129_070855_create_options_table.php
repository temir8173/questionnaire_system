<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%options}}`.
 */
class m210129_070855_create_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%options}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'anketa_id' => $this->integer(),
            'is_multiple' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%options}}');
    }
}
