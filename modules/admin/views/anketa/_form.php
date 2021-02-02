<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anketa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_kaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_rus')->textInput(['maxlength' => true]) ?>

    <p><b>Вопросы</b></p>

    <?php foreach( $model->questions as $question ) : ?>

    	<?= $this->render('/question/view', [
            'without_breadcrumbs' => true,
	        'model' => $question,
	    ]) ?>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
