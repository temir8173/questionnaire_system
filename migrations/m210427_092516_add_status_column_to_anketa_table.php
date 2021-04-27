<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%anketa}}`.
 */
class m210427_092516_add_status_column_to_anketa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%anketa}}', 'status', $this->integer());
        $this->update('{{%anketa}}', ['status' => '1']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%anketa}}', 'status');
    }
}
