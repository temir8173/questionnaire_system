<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use app\models\AnketaCategory;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnketaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Анкеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anketa-index">

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
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'name_kaz',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute' => 'category_id',
                'headerOptions' => ['style' => 'width: 30%'],
                'value' => function($data){
                    return ($data->category) ? StringHelper::truncate($data->category->name_rus, 75) : 'Общие';
                },
                'filter' => AnketaCategory::find()->select(['name_rus', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width: 5%'],
                'value' => function($data){
                    return ($data->status == 1) ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
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
