<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Преподаватели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'width: 45%'],
            ],
            [
                'attribute' => 'school_id',
                'format' => 'raw',
                'value' => function($data){
                    return $data->school->name_rus;
                },
                'headerOptions' => ['style' => 'width: 45%'],
                'filter' => $schools,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
