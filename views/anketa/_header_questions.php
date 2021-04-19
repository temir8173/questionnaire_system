<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Institut;

?>

<?php foreach ( $headerFields as $index => $headerField ) : ?>

    <?php if ($headerField->type == 'custom' && Yii::$app->language == 'kk' ) : ?>
    	<p><?= $headerField->name_kaz ?></p>
	<?php elseif ($headerField->type == 'custom' && Yii::$app->language == 'ru' ) : ?>
    	<p><?= $headerField->name_rus ?></p>
	<?php endif; ?>

    <?= $form->field($headerResults[$index], "[$index]header_question_id")->hiddenInput(['value' => $headerField->id])->label(false) ?>
    

    <?php if ( $headerField->type == 'institute' ) : ?>
		<div class="question-box">
			<?php
				$institutes = Institut::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column();
				unset($institutes[57]);
			?>
			<?= $form->field($headerResults[$index], "[$index]answer_id")->dropDownList($institutes, [
				'id' => 'institute',
				'class'=>'form-control int required',
				'prompt'=> '',
			])->label(Yii::t('common', 'Институт')) ?>
		</div>
    <?php elseif ( $headerField->type == 'course' ) : ?>
		<div class="question-box">
			<?= $form->field($headerResults[$index], "[$index]answer_custom")->dropDownList($headerField->courses, [
				'id' => 'course',
				'class'=>'form-control int required',
				'prompt'=> '',
			])->label(Yii::t('common', 'Курс')) ?>
		</div>
    <?php elseif ( $headerField->type == 'gender' ) : ?>
		<div class="question-box">
			<?= $form->field($headerResults[$index], "[$index]answer_custom")->dropDownList([
        'male' => Yii::t('common', 'Ер'), 
        'female' => Yii::t('common', 'Әйел'),
    ], [
				'id' => 'course',
				'class'=>'form-control int required',
				'prompt'=> '',
			])->label(Yii::t('common', 'Жынысыңыз')) ?>
		</div>
    <?php elseif ( $headerField->type == 'school' ) : ?>
		<div class="question-box">
			<label class="control-label" for="school-institute"><?= Yii::t('common', 'Институт') ?></label>
	    	<?= Html::dropDownList('Header[institute]','', Institut::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column(),[
				'id' => 'school-institute',
				'class'=>'form-control select-dynamic',
				'prompt'=> Yii::t('common', '-- Таңдаңыз --'),
				'data' => [
					'target' => 'school',
					'target-insert' => 'school-school',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<?= $form->field($headerResults[$index], "[$index]answer_id")->dropDownList([], [
				'id' => 'school-school',
				'class'=>'form-control int required',
				'disabled'=> 'disabled',
				'prompt'=> '',
			])->label(Yii::t('common', 'Жоғары мектеп')) ?>
		</div>
    <?php elseif ( $headerField->type == 'subject' ) : ?>
		<div class="question-box">
			<label class="control-label" for="subject-institute"><?= Yii::t('common', 'Институт') ?></label>
	    	<?= Html::dropDownList('Header[institute]','', Institut::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column(),[
				'id' => 'subject-institute',
				'class'=>'form-control select-dynamic',
				'prompt'=> Yii::t('common', '-- Таңдаңыз --'),
				'data' => [
					'target' => 'school',
					'target-insert' => 'subject-school',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<label class="control-label" for="subject-school"><?= Yii::t('common', 'Жоғары мектеп') ?></label>
			<?= Html::dropDownList('Header[school]','', [],[
				'id' => 'subject-school',
				'class'=>'form-control select-dynamic',
				'disabled'=> 'disabled',
				'prompt'=> '',
				'data' => [
					'target' => 'subject',
					'target-insert' => 'subject',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<?= $form->field($headerResults[$index], "[$index]answer_id")->dropDownList([], [
				'id' => 'subject',
				'class'=>'form-control int required',
				'disabled'=> 'disabled',
				'prompt'=> '',
			])->label(Yii::t('common', 'Пән')) ?>
		</div>
	<?php elseif ( $headerField->type == 'teacher' ) : ?>
		<div class="question-box">
			<label class="control-label" for="teacher-institute"><?= Yii::t('common', 'Институт') ?></label>
			<?= Html::dropDownList('Header[institute]','', Institut::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column(),[
				'id' => 'teacher-institute',
				'class'=>'form-control select-dynamic',
				'prompt'=> Yii::t('common', '-- Таңдаңыз --'),
				'data' => [
					'target' => 'school',
					'target-insert' => 'teacher-school',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<label class="control-label" for="teacher-school"><?= Yii::t('common', 'Жоғары мектеп') ?></label>
			<?= Html::dropDownList('Header[school]','', [],[
				'id' => 'teacher-school',
				'class'=>'form-control select-dynamic',
				'disabled'=> 'disabled',
				'prompt'=> '',
				'data' => [
					'target' => 'teacher',
					'target-insert' => 'teacher',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<?= $form->field($headerResults[$index], "[$index]answer_id")->dropDownList([], [
				'id' => 'teacher',
				'class'=>'form-control int required',
				'disabled'=> 'disabled',
				'prompt'=> '',
			])->label(Yii::t('common', 'Оқытушы')) ?>
		</div>
	<?php elseif ( $headerField->type == 'program' ) : ?>
		<div class="question-box">
			<label class="control-label" for="program-institute"><?= Yii::t('common', 'Институт') ?></label>
			<?= Html::dropDownList('Header[institute]','', Institut::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column(),[
				'id' => 'program-institute',
				'class'=>'form-control select-dynamic',
				'prompt'=> Yii::t('common', '-- Таңдаңыз --'),
				'data' => [
					'target' => 'school',
					'target-insert' => 'program-school',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<label class="control-label" for="program-school"><?= Yii::t('common', 'Жоғары мектеп') ?></label>
			<?= Html::dropDownList('Header[school]','', [],[
				'id' => 'program-school',
				'class'=>'form-control select-dynamic',
				'disabled'=> 'disabled',
				'prompt'=> '',
				'data' => [
					'target' => 'program',
					'target-insert' => 'program',
					'ajaxurl' => Url::toRoute('ajax/select')
				],
			]) ?>
			<?= $form->field($headerResults[$index], "[$index]answer_id")->dropDownList([], [
				'id' => 'program',
				'class'=>'form-control int required',
				'disabled'=> 'disabled',
				'prompt'=> '',
			])->label(Yii::t('common', 'Білім беру бағдарламасы')) ?>
		</div>
		
	<?php else : ?>
		<div class="question-box">
			<?= $form->field($headerResults[$index], "[$index]answer_custom")->textInput(['class' => 'form-control text required'])->label(false) ?>
		</div>
	<?php endif;?>

<?php endforeach; ?>