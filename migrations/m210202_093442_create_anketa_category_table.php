<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%anketa_category}}`.
 */
class m210202_093442_create_anketa_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%anketa_category}}', [
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
        $this->dropTable('{{%anketa_category}}');
    }
}
