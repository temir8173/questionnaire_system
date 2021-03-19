<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Обновить: ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => Url::to(['anketa/update', 'id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы анкеты', 'url' => Url::to(['index', 'anketa_id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'options' => $options,
        'qcategories' => $qcategories,
        'anketa_id' => $model->anketa_id
    ]) ?>

</div>
