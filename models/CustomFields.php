<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "custom_fields".
 *
 * @property int $id
 * @property string $name_rus
 * @property string $name_kaz
 */
class CustomFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'custom_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_rus', 'name_kaz'], 'required'],
            [['name_rus', 'name_kaz'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_rus' => 'Название на русском',
            'name_kaz' => 'Қазақша атауы',
        ];
    }
}
