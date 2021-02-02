<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QCategory */

$this->title = 'Update Q Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Q Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qcategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
