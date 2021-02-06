<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории вопросов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qcategory-index">

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
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'name_rus',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'anketa_id',
                'headerOptions' => ['style' => 'width: 30%'],
                'value' => function($data){
                    return $data->anketa->name_rus;
                },
                'filter' => false
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
