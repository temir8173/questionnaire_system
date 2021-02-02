<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institut".
 *
 * @property int $id
 * @property string|null $name_rus
 * @property string|null $name_kaz
 */
class Institut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institut';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus'], 'required', 'message' => 'Заполните обязательное поле {attribute}'],
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
