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
        return $this->hasOne(Anketa::className(), ['id' => 'anketa_id']);
    }

    public function getResults()
    {
        return $this->hasMany(HeaderResults::className(), ['header_question_id' => 'id']);
    }

    public function getResultsArray()
    {
        foreach ($this->results as $result) { 
            if ( $this->type == 'custom' ) {
                $resultsArray[$result->answer_custom] = $result->answer_custom;
            } elseif ( $this->type == 'teacher' ) {
                $resultsArray[$result->answer_id] = $result->name->name;
            } else {
                $resultsArray[$result->answer_id] = $result->name->name_rus;
            }
        }
        return $resultsArray;
    }

    public static function getTypes() {
        return [
            'institute' => Yii::t('common', 'Институт'),
            'school' => Yii::t('common', 'Жоғары мектеп'),
            'subject' => Yii::t('common', 'Пән'),
            'teacher' => Yii::t('common', 'Оқытушы'),
            'program' => Yii::t('common', 'Білім беру бағдарламасы'),
            'custom' => Yii::t('common', 'Произвольное поле'),
        ];
    }

    public function getTypeName() {
        return self::getTypes()[$this->type];
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
