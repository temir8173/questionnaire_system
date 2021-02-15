<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HeaderFields */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'К анекете', 'url' => ['anketa/update', 'id' => $anketa_id]];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы о респонденте', 'url' => ['index', 'anketa_id' => $anketa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    if ($standart) {
    	echo $this->render('_form_st', [
	        'model' => $model,
	        'anketa_id' => $anketa_id
	    ]);
	} else {
		echo $this->render('_form', [
	        'model' => $model,
	        'anketa_id' => $anketa_id
	    ]);
	}
	?>

</div>
