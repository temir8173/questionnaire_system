<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AnketaCategory;
use yii\widgets\ActiveForm;

?>

<div class="container">
	
	<div class="col-lg-6">
		
		<?php $form = ActiveForm::begin([
		    'id' => 'login-form',
		    'action' => Url::toRoute('results/export'),
		    'options' => ['class' => ''],
		]) ?>

		<h1><?= Yii::t('common', 'Сауалнама нәтижелері') ?></h1>



		<label class="control-label" for="result-category"><?= Yii::t('common', 'Сауалнама категориялары') ?></label>
		<?= Html::dropDownList('Result[category_id]','', AnketaCategory::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->indexBy('id')->column(),[
			'id' => 'result-category',
			'class'=>'form-control select-dynamic',
			'prompt'=> Yii::t('common', '-- Таңдаңыз --'),
			'data' => [
				'target' => 'anketa',
				'target-insert' => 'result-anketa',
				'ajaxurl' => Url::toRoute('/ajax/select')
			],
		]) ?>
		<label class="control-label" for="result-anketa"><?= Yii::t('common', 'Сауалнамалар') ?></label>
		<?= Html::dropDownList('Result[anketa_id]','', [],[
			'id' => 'result-anketa',
			'class'=>'form-control select-dynamic',
			'disabled'=> 'disabled',
			'prompt'=> '',
			'data' => [
				'target' => 'result-fields',
				'target-insert' => 'result-fields',
				'ajaxurl' => Url::toRoute('/ajax/result-params')
			],
		]) ?>
		<label class="control-label" for="result-language"><?= Yii::t('common', 'Тіл') ?></label>
		<?= Html::dropDownList('Result[language]','', ['kk' => Yii::t('common', 'қазақ'), 'ru' => Yii::t('common', 'орыс')],[
			'id' => 'result-language',
			'class'=>'form-control',
			'prompt'=> Yii::t('common', 'Барлық тілдер'),
		]) ?>

		<div id="result-fields">
			
		</div>

		<div class="form-group">
		        <br><?= Html::submitButton(Yii::t('common', 'Жүктеу'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end() ?>


	</div>




</div>

