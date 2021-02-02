<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "q_category".
 *
 * @property int $id
 * @property string $name_kaz
 * @property string $name_rus
 */
class QCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'q_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus'], 'required'],
            [['name_kaz', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_kaz' => 'Name Kaz',
            'name_rus' => 'Name Rus',
        ];
    }
}
