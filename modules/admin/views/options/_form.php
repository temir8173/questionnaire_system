<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= (Yii::$app->controller->action->id != 'create') ? Html::a('Элементы', Url::to(['option-items/index', 'option_id' => $model->id]), ['class' => 'btn btn-info', 'target'=>'_blank', 'style' => 'margin: 5px 5px 15px 0;']) : '' ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
