<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_kaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_rus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anketa_id')->hiddenInput(['value' => $anketa_id])->label(false) ?>

    <?= $form->field($model, 'q_category_id')->dropdownList(
        $qcategories, ['prompt'=>'Выберите значение']
    ) ?>

    <?= $form->field($model, 'option_id')->dropdownList(
        $options, ['prompt'=>'Выберите значение']
    ) ?>

    <?php //var_dump($model->options->optionitems); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= (Yii::$app->controller->action->id != 'create') ? Html::submitInput('Сохранить и выйти', ['name' => 'close', 'class' => 'btn btn-primary']) : '' ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
