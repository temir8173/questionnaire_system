<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OptionItems */

$this->title = $model->name_rus;
$this->params['breadcrumbs'][] = ['label' => 'К варианту ответа', 'url' => ['options/update', 'id' => $model->option_id]];
$this->params['breadcrumbs'][] = ['label' => 'Элементы', 'url' => ['index', 'option_id' => $model->option_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="option-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'option_id' => $model->option_id], [
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
                'attribute' => 'is_own_answer',
                'value' => function($data){
                    return ($data->is_own_answer == 1) ? 'да' : 'нет';
                },
            ],
            [
                'attribute' => 'option_id',
                'value' => function($data){
                    return $data->option->name;
                },
            ],
        ],
    ]) ?>

</div>
