<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if( !empty($headerFields) && !empty($headerFields[0]->results) ) : ?>
	<h3><?= Yii::t('common', 'Респонденттер туралы мәліметтер') ?></h3>
<?php endif; ?>

<?php foreach ($headerFields as $headerField) : ?>
	<?php if( !empty($headerField->results) ) : ?>
		<label  for="#header-field-<?= $headerField->id ?>">
			<?= ( $headerField->type == 'custom' ) ? ( (Yii::$app->language == 'kk') ? $headerField->name_kaz : $headerField->name_rus ) : $headerField->typeName ?>
		</label>

		<?= Html::dropdownList("Result[header][$headerField->id][fields][]",'', array_unique($headerField->resultsArray),[
			'id' => 'header-field-'.$headerField->id,
			'class'=>'form-control select-dynamic',
			'multiple'=>'multiple',
			'data' => [
				'target' => 'anketa',
				'target-insert' => 'result-anketa',
				'ajaxurl' => Url::toRoute('ajax/select')
			],
		]) ?>
		<?= Html::hiddenInput("Result[header][$headerField->id][type]", $headerField->type, ['class' => '']) ?>
	<?php endif; ?>

<?php endforeach; ?>

<?php if( empty($headerFields) || empty($headerFields[0]->results) ) : ?>
	<br><br><p><?= Yii::t('common', 'Нәтижелер жоқ') ?></p>
<?php endif; ?>