<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

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
                'headerOptions' => ['style' => 'width: 40%'],
            ],
            [
                'attribute' => 'institute_id',
                'format' => 'raw',
                'value' => function($data){
                    return (isset($data->institute)) ? $data->institute->name_rus : '';
                },
                'headerOptions' => ['style' => 'width: 40%'],
                'filter' => $institutes,
            ],

            [
                'attribute' => 'course',
                'headerOptions' => ['style' => 'width: 10%'],
                'filter' => [
                   1=>'1 курс',
                   2=>'2 курс',
                   3=>'3 курс',
                   4=>'4 курс',
                   5=>'5 курс',
                ], /*Html::dropDownList('GroupSearch[course]', 'null', [
                   1=>'1 курс',
                   2=>'2 курс',
                   3=>'3 курс',
                   4=>'4 курс',
                   5=>'5 курс',
                ], ['prompt' => '-', 'class' => 'form-control']),*/
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
