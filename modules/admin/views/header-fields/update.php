<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\HeaderFields */

$this->title = 'Изменить: ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => Url::to(['anketa/update', 'id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы о респонденте', 'url' => Url::to(['index', 'anketa_id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="header-fields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
