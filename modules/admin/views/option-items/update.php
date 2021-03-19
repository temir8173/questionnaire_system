<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */

$this->title = 'Изменить: ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'К варианту ответа', 'url' => ['options/update', 'id' => $model->option_id]];
$this->params['breadcrumbs'][] = ['label' => 'Элементы', 'url' => ['index', 'option_id' => $model->option_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="option-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option_id' => $model->option_id,
    ]) ?>

</div>
