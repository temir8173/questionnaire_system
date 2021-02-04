<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HeaderFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы о респонденте';
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => Url::to(['anketa/update', 'id' => $anketa_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', Url::to(['create', 'anketa_id' => $anketa_id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'anketa_id',
                'headerOptions' => ['style' => 'width: 44%'],
                'value' => function($data){
                    return $data->anketa->name_rus;
                },
                'filter' => false
            ],
            [
                'attribute' => 'name_rus',
                'headerOptions' => ['style' => 'width: 22%'],
            ],
            [
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 22%'],
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['style' => 'width: 3%'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
