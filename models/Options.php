<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $name
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['anketa_id', 'is_multiple'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    
    public function getOptionitems()
    {
        return $this->hasMany(OptionItems::className(), ['option_id' => 'id']);
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
            'name' => 'Название',
            'anketa_id' => 'Анкета',
            'is_multiple' => 'Множественный выбор',
        ];
    }
}
