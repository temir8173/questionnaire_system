<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\School */

$this->title = 'Редактирование: ' . $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'Высшие школы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="school-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'institutes' => $institutes
    ]) ?>

</div>
