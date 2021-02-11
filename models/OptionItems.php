<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_items".
 *
 * @property int $id
 * @property string $name_kaz
 * @property string $name_rus
 * @property int|null $type
 * @property int|null $option_id
 */
class OptionItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus'], 'required'],
            [['option_id'], 'integer'],
            [['type', 'name_kaz', 'name_rus'], 'string', 'max' => 255],
        ];
    }
    
    public function getOption()
    {
        return $this->hasOne(Options::className(), ['id' => 'option_id']);
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
            'type' => 'Тип ответа',
            'option_id' => 'Option ID',
        ];
    }
}
