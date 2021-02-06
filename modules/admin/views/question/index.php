<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы анкеты';
$this->params['breadcrumbs'][] = ['label' => 'К анкете', 'url' => ['anketa/update', 'id' => $anketa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create', 'anketa_id' => $anketa_id], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Категории вопросов', ['qcategory/index', 'anketa_id' => $anketa_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>

        <?= Html::a('Варианты ответов', ['options/index', 'anketa_id' => $anketa_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
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
                'attribute' => 'q_category_id',
                'headerOptions' => ['style' => 'width: 25%'],
                'value' => function($data){
                    return ($data->category) ? StringHelper::truncate($data->category->name_rus, 75) : 'Общие';
                },
                'filter' => $qcategories
            ],
            [
                'attribute' => 'anketa_id',
                'headerOptions' => ['style' => 'width: 5%'],
                'filter' => false
            ],
            //'option_id',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['style' => 'width: 3%'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>


</div>
