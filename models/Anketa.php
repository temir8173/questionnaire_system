<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anketa".
 *
 * @property int $id
 * @property string $name_kaz
 * @property string $name_rus
 */
class Anketa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anketa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus', 'category_id'], 'required', 'message' => 'Заполните обязательное поле {attribute}'],
            [['category_id', 'status'], 'integer'],
            [['name_kaz', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['anketa_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(AnketaCategory::className(), ['id' => 'category_id']);
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
            'category_id' => 'Категория',
            'status' => 'Активный',
        ];
    }
}
