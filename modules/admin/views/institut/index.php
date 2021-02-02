<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstitutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Институты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institut-index">

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
                'headerOptions' => ['style' => 'width: 47%'],
            ],
            [
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 47%'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия', 
                'headerOptions' => ['style' => 'width: 5%'],
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
