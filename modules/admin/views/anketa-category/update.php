<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnketaCategory */

$this->title = 'Категория: ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'Категории анкет', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="anketa-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
