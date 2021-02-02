<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property int $id
 * @property string|null $name_rus
 * @property string|null $name_kaz
 * @property int|null $institute_id
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_kaz', 'name_rus'], 'required', 'message' => 'Заполните обязательное поле {attribute}'],
            [['institute_id'], 'integer'],
            [['name_rus', 'name_kaz'], 'string', 'max' => 255],
        ];
    }

    public function getInstitute()
    {
        return $this->hasOne(Institut::className(), ['id' => 'institute_id']);
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
            'institute_id' => 'Институт',
        ];
    }
}
