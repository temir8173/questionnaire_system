<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string|null $name_rus
 * @property string|null $name_kaz
 * @property int|null $school_id
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus'], 'required'],
            [['school_id'], 'integer'],
            [['name_rus', 'name_kaz'], 'string', 'max' => 255],
        ];
    }

    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
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
            'school_id' => 'Высшая школа',
        ];
    }
}
