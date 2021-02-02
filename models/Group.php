<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 * @property int|null $institute_id
 * @property int|null $course
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['institute_id', 'course'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'institute_id' => 'Институт',
            'course' => 'Курс',
        ];
    }
}
