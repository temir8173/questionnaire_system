<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'К варианту ответа', 'url' => ['options/update', 'id' => $option_id]];
$this->params['breadcrumbs'][] = ['label' => 'Элементы', 'url' => ['index', 'option_id' => $option_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option_id' => $option_id,
    ]) ?>

</div>
