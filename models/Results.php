<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "results".
 *
 * @property int $id
 * @property string $language
 * @property int $anketa_id
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language', 'anketa_id'], 'required'],
            [['anketa_id'], 'integer'],
            [['language'], 'string', 'max' => 255],
        ];
    }

    public function getResultsItems()
    {
        return $this->hasMany(ResultItems::classname(), ['result_id' => 'id']);
    }

    public function getHeaderResults()
    {
        return $this->hasMany(HeaderResults::classname(), ['result_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'anketa_id' => 'Anketa ID',
        ];
    }

}
