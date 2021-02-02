<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Institut */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Институты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institut-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
