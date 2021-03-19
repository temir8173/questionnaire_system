<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = Yii::t('common', 'Сауалнама');
$this->params['breadcrumbs'][] = ['label' => ( Yii::$app->language == 'kk' ) ? $anketa->category->name_kaz : $anketa->category->name_rus , 'url' => ['/anketa/index', 'category_id' => $anketa->category->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">

    <div class="questionary__inner">
    	<div class="col-md-6" style="margin-left: -30px;">

            <h1><?= (Yii::$app->language == 'kk') ? $anketa->name_kaz : $anketa->name_rus ?></h1>

            <?php $form = ActiveForm::begin([
                'enableClientValidation'=>false, 
                'fieldConfig' => ['options' => ['tag' => false ] ],
                'options' => [
                    'class' => 'rating_form ajax-form'
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

                <div class="inline__anteta1-btn input__btn-update">
                    <?= Html::submitButton('Отправить результаты', ['name' => 'submit', 'class' => 'button__update']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>

    <div class="col-md-6">
        <div class="anketa1__info-text">
            <div class="bd-callout bd-callout-info">
                <?php if( Yii::$app->language == 'kk' ) : ?>
                    <p class="info__text">Осы сауалнаманы толтыруыңызды сұраймыз. Жүргізілген зерттеудің мақсаты білім алушылардың оларға қолдау көрсету деңгейін анықтау болып табылады.</p>
                    <p class="info__text">Барлық сұрақтарға нақты жауап беруді сұраймыз, өйткені сіздің жауаптарыңыз оқу сапасын басқару жүйесін жетілдіру үшін эмпирикалық негіз болады.</p>
                <?php elseif( Yii::$app->language == 'ru' ) : ?>
                    <p class="info__text">
                    Настоящая  анкета  разработана с целью определения и дальнейшего повышения уровня удовлетворенности обучающихся качеством предоставления образовательных услуг университета.</p>
                    <p class="info__text">
                    Анкета анонимная, при обработке анкеты данные будут использованы в обобщенном виде. Для заполнения Вам необходимо выбрать один вариант ответа, соответствующий Вашему мнению.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>