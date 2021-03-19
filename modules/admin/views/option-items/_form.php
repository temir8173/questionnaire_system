<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="option-items-form">

    <?php 

    if (isset($action)) 
        $params = ['action' => [$action]];
    else {
        $params = [];
        $action= '';
    }

    ?>

    <?php $form = ActiveForm::begin($params); ?>

    <?= $form->field($model, 'name_kaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_rus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropdownList(
        [ 'own' => 'Свой вариант респондента', 'percentage' => 'Процентное значение'], ['prompt'=>'Стандартный']
    ) ?>

    <?= $form->field($model, 'option_id')->hiddenInput(['value' => $option_id])->label(false) ?>

    <div class="form-group">
        <?= (Yii::$app->controller->action->id != 'create' && $action != 'create') ? Html::submitButton('Сохранить', ['class' => 'btn btn-success']) : '' ?>
        <?= Html::submitInput(($action != 'create') ? 'Сохранить и выйти' : 'Сохранить', ['name' => 'close', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
