<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "results".
 *
 * @property int $id
 * @property string $language
 * @property int $question_id
 * @property int $answer_id
 * @property string|null $answer_custom
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
            [['language', 'question_id', 'answer_id'], 'required'],
            [['question_id', 'answer_id'], 'integer'],
            [['language', 'answer_custom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'question_id' => 'Question ID',
            'answer_id' => 'Answer ID',
            'answer_custom' => 'Answer Custom',
        ];
    }
}
