<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => Url::to(['anketa/update', 'id' => $anketa_id])];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы анкеты', 'url' => Url::to(['index', 'anketa_id' => $anketa_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'options' => $options,
        'qcategories' => $qcategories,
        'anketa_id' => $anketa_id
    ]) ?>

</div>
