<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QCategory */

$this->title = 'Create Q Category';
$this->params['breadcrumbs'][] = ['label' => 'Q Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
