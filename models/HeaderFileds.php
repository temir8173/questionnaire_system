<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "header_fileds".
 *
 * @property int $id
 * @property int $anketa_id
 * @property string $obj
 * @property int|null $obj_id
 */
class HeaderFileds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'header_fileds';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anketa_id', 'obj'], 'required'],
            [['anketa_id', 'obj_id'], 'integer'],
            [['obj'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anketa_id' => 'Анкета',
            'obj' => 'Поля в шапке анкеты',
            'obj_id' => 'Obj ID',
        ];
    }
}
