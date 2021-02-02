<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%anketa}}`.
 */
class m210202_093714_add_category_column_to_anketa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%anketa}}', 'category_id', $this->integer(11)->notNull()->after('name_rus'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%anketa}}', 'category_id');
    }
}
