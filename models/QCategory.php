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
            [['name_kaz', 'name_rus', 'anketa_id'], 'required'],
            [['anketa_id'], 'integer'],
            [['name_kaz', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    public function getAnketa()
    {
        return $this->hasOne(Anketa::className(), ['id' => 'anketa_id']);
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
            'anketa_id' => 'Анкета',
        ];
    }
}
