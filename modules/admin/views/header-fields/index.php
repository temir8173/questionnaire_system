<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\HeaderFields;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HeaderFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы о респонденте';
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => ['anketa/update', 'id' => $anketa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', Url::to(['create', 'anketa_id' => $anketa_id]), ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить стандартное поле', Url::to(['create', 'anketa_id' => $anketa_id, 'standart' => true]), ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'anketa_id',
                'headerOptions' => ['style' => 'width: 22%'],
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
                'attribute' => 'type',
                'headerOptions' => ['style' => 'width: 22%'],
                'value' => function($data)
                {
                    return ($data->typeName) ? $data->typeName : 'Произвольное поле';
                },
                'filter' => array_merge(HeaderFields::getTypes(), ['custom' => 'Произвольное поле']),
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
