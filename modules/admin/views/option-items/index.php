<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OptionItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Элементы';
$this->params['breadcrumbs'][] = ['label' => 'К варианту ответа', 'url' => ['options/update', 'id' => $option_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option_id' => $option_id,
        'action' => 'create',
    ]) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 3%'],
            ],

            [
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'name_rus',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'is_own_answer',
                'headerOptions' => ['style' => 'width: 5%'],
                'value' => function($data){
                    return ($data->is_own_answer == 1) ? 'да' : 'нет';
                },
                'filter' => false
            ],
            [
                'attribute' => 'option_id',
                'headerOptions' => ['style' => 'width: 25%'],
                'value' => function($data){
                    return $data->option->name;
                },
                'filter' => false
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия', 
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
