<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Варианты ответов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create', 'anketa_id' => $anketa_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'width: 40%'],
            ],
            [
                'attribute' => 'is_multiple',
                'headerOptions' => ['style' => 'width: 5%'],
                'value' => function($data){
                    return ($data->is_multiple == 1) ? 'Да' : 'Нет';
                }
            ],
            [
                'attribute' => 'anketa_id',
                'headerOptions' => ['style' => 'width: 40%'],
                'value' => function($data){
                    return ($data->anketa) ? $data->anketa->name_rus : 'Общие';
                },
                'filter' => false
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия', 
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
