<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result_items".
 *
 * @property int $id
 * @property int $question_id
 * @property int $result_id
 * @property int $answer_id
 * @property string|null $answer_custom
 */
class ResultItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'result_id', 'answer_id'], 'required'],
            [['question_id', 'result_id', 'answer_id'], 'integer'],
            [['answer_custom'], 'string', 'max' => 255],
        ];
    }

    public function getQuestion()
    {
        return $this->hasOne(Question::classname(), ['id' => 'question_id']);
    }

    public function getOptionItem()
    {
        return $this->hasOne(OptionItems::classname(), ['id' => 'answer_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'result_id' => 'Result ID',
            'answer_id' => 'Answer ID',
            'answer_custom' => 'Answer Custom',
        ];
    }
}
