<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */

$this->title = 'Create Option Items';
$this->params['breadcrumbs'][] = ['label' => 'Option Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
