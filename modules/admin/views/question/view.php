<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

if ( !$without_breadcrumbs ) {
    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="question-view">

    <h1><?= Html::encode($model->id) ?></h1>

    <p>
        <?= Html::a('Update', ['question/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['question/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name_kaz',
            'name_rus',
            'q_category_id',
            'option_id',
        ],
    ]) ?>

</div>
