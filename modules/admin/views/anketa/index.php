<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            'name_kaz',
            'name_rus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
