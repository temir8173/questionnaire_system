<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Высшие школы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-index">

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
                'attribute' => 'name_rus',
                'headerOptions' => ['style' => 'width: 35%'],
            ],
            [
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 35%'],
            ],
            //'institute_id',
            [
                'attribute' => 'institute_id',
                'format' => 'raw',
                'value' => function($data){
                    return (isset($data->institute)) ? $data->institute->name_rus : '';
                },
                'headerOptions' => ['style' => 'width: 25%'],
                'filter' => $institutes
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['style' => 'width: 3%'],
                'buttons' =>
                    [
                        'delete'=>function($url,$model,$key)
                        {
                            return Html::a( "<span class=\"glyphicon glyphicon-trash\"></span>" , $url, [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Вы уверены что хотите удалить?',
                                    'method' => 'post',
                                ],
                            ] ); //use Url::to() in order to change $url
                        }
                    ],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
