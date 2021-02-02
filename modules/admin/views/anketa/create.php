<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anketa */

$this->title = 'Create Anketa';
$this->params['breadcrumbs'][] = ['label' => 'Anketas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anketa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
