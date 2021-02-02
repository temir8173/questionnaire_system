<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "header_results".
 *
 * @property int $id
 * @property int $header_question_id
 * @property int $result_id
 * @property int|null $answer_id
 * @property string|null $answer_custom
 */
class HeaderResults extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'header_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header_question_id', 'result_id'], 'required'],
            [['header_question_id', 'result_id', 'answer_id'], 'integer'],
            [['answer_custom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header_question_id' => 'Header Question ID',
            'result_id' => 'Result ID',
            'answer_id' => 'Answer ID',
            'answer_custom' => 'Answer Custom',
        ];
    }
}
