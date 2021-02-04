<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnketaCategory */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Категории анкет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anketa-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
