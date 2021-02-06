<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "header_fields".
 *
 * @property int $id
 * @property int $anketa_id
 * @property string $type
 * @property string $name_rus
 * @property string $name_kaz
 */
class HeaderFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'header_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anketa_id', 'type', 'name_rus', 'name_kaz'], 'required'],
            [['anketa_id'], 'integer'],
            [['type', 'name_rus', 'name_kaz'], 'string', 'max' => 255],
        ];
    }

    public function getAnketa()
    {
        return $this->hasOne(Question::className(), ['id' => 'anketa_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anketa_id' => 'Анкета',
            'type' => 'Тип',
            'name_rus' => 'Название на русском',
            'name_kaz' => 'Қазақша атауы',
        ];
    }
}