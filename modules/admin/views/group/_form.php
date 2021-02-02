<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'institute_id')->dropdownList(
        $institutes, ['prompt'=>'Выберите значение']
    ) ?>

    <?= $form->field($model, 'course')->dropdownList(
        [
           1=>'1 курс',
           2=>'2 курс',
           3=>'3 курс',
           4=>'4 курс',
           5=>'5 курс',
        ], ['prompt'=>'Выберите значение']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
