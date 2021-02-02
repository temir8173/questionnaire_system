<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%anketa}}`.
 */
class m210129_053704_create_anketa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%anketa}}', [
            'id' => $this->primaryKey(),
            'name_kaz' => $this->string()->notNull(),
            'name_rus' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%anketa}}');
    }
}
