<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="container">

	<div class="col-one">
        <div class="questionary__inner">

            <h1><?= (Yii::$app->language == 'kk') ? $anketa->name_kaz : $anketa->name_rus ?></h1>

            <?php $form = ActiveForm::begin([
                'enableClientValidation'=>false, 
                'fieldConfig' => ['options' => ['tag' => false ] ],
                'options' => [
                    'class' => 'ajax-form'
                 ]
            ]); ?>

                <?= $form->field($result, "anketa_id")->hiddenInput(['value' => $anketa->id])->label(false) ?>
                <?= $form->field($result, "language")->hiddenInput(['value' => Yii::$app->language])->label(false) ?>

                <?= $this->render('_header_questions', [
                    'form' => $form,
                    'headerFields' => $headerFields,
                    'headerResults' => $headerResults,
                ]) ?>

                <?= $this->render('_questions', [
                    'form' => $form,
                    'questions' => $questions,
                    'resultItems' => $resultItems,
                ]) ?>

                <?= Html::submitInput('Отправить результаты', ['name' => 'submit', 'class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>

</div>