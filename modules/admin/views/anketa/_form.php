<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

    <?= $form->field($model, 'category_id')->dropdownList(
        $categories, ['prompt'=>'Выберите значение']
    ) ?>

    
    <?= (Yii::$app->controller->action->id != 'create') ? Html::a('Вопросы о респонденте', Url::to(['header-fields/index', 'anketa_id' => $model->id]), ['class' => 'btn btn-info', 'style' => 'margin: 15px 5px 30px 0;']) : '' ?>
    <?= (Yii::$app->controller->action->id != 'create') ? Html::a('Вопросы', Url::to(['question/index', 'anketa_id' => $model->id]), ['class' => 'btn btn-info', 'style' => 'margin: 15px 0 30px 0;']) : '' ?>


    <?php if(0) : ?>

        <p><b>Вопросы</b></p>

        <?php foreach( $model->questions as $question ) : ?>

        	<?= $this->render('_form', [
                'without_breadcrumbs' => true,
    	        'model' => $question,
    	    ]) ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <?php if(0) : ?>

        <p><b>Вопросы</b></p>

        <?php foreach( $model->questions as $question ) : ?>

            <?= $this->render('/question/view', [
                'without_breadcrumbs' => true,
                'model' => $question,
            ]) ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <div class="form-group">
        <?= (Yii::$app->controller->action->id != 'create') ? Html::submitButton('Сохранить', ['class' => 'btn btn-success']) : '' ?>
        <?= Html::submitInput('Сохранить и выйти', ['name' => 'close', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
