<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $name_kaz
 * @property string $name_rus
 * @property int $anketa_id
 * @property int|null $q_category_id
 * @property int|null $option_id
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus', 'anketa_id', 'option_id'], 'required', 'message' => 'Заполните обязательное поле {attribute}'],
            [['anketa_id', 'q_category_id', 'option_id'], 'integer'],
            [['name_kaz', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    public function getOptions()
    {
        return $this->hasOne(Options::className(), ['id' => 'option_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(QCategory::className(), ['id' => 'q_category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_kaz' => 'Вопрос на казахском',
            'name_rus' => 'Вопрос на русском',
            'anketa_id' => 'Anketa ID',
            'q_category_id' => 'Категория',
            'option_id' => 'Варанты ответа',
        ];
    }
}
