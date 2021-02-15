<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\HeaderFields;

/* @var $this yii\web\View */
/* @var $model app\models\HeaderFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="header-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'anketa_id')->hiddenInput(['value' => $anketa_id])->label(false) ?>

    <?= $form->field($model, 'type')->dropdownList(
        HeaderFields::getTypes(), ['prompt'=>'Выберите значение']
    ) ?>

    <?= $form->field($model, 'name_rus')->hiddenInput(['value' => 'standart', 'maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'name_kaz')->hiddenInput(['value' => 'standart', 'maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= (Yii::$app->controller->action->id != 'create') ? Html::submitButton('Сохранить', ['class' => 'btn btn-success']) : '' ?>
        <?= Html::submitInput('Сохранить и выйти', ['name' => 'close', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
