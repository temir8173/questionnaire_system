<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 */
class m210209_064921_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'language' => $this->string()->notNull(),
            'anketa_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%results}}');
    }
}
