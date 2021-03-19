<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Вопросы анкеты', 'url' => Url::to(['index', 'anketa_id' => $model->anketa_id])];
    $this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="question-view">

    <h1><?= Html::encode($model->name_rus) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_kaz',
            'name_rus',
            [
                'attribute'=>'q_category_id',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->category !== null) ? $data->category->name_rus : '';
                },
            ],
            [
                'attribute'=>'option_id',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->options !== null) ? $data->options->name : '';
                },
            ],
        ],
    ]) ?>

</div>
