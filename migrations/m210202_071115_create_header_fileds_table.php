<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%header_fileds}}`.
 */
class m210202_071115_create_header_fileds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%header_fileds}}', [
            'id' => $this->primaryKey(),
            'anketa_id' => $this->integer()->notNull(),
            'obj' => $this->string()->notNull(),
            'obj_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%header_fileds}}');
    }
}
