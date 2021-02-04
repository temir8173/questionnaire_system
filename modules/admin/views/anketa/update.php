<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */

$this->title = 'Изменить анкету ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'Анкеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="anketa-update">

    <h1 style="font-size: 24px; line-height: 1.5;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>


</div>
