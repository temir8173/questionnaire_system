<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="option-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_kaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_rus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_own_answer')->dropdownList(
        [ 1 => 'Да', 0 => 'Нет'], ['prompt'=>'Выберите значение']
    ) ?>

    <?= $form->field($model, 'option_id')->hiddenInput(['value' => $option_id])->label(false) ?>

    <div class="form-group">
        <?= (Yii::$app->controller->action->id != 'create') ? Html::submitButton('Сохранить', ['class' => 'btn btn-success']) : '' ?>
        <?= Html::submitInput('Сохранить и выйти', ['name' => 'close', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
