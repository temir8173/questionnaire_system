<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OptionItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Option Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Option Items', ['create'], ['class' => 'btn btn-success']) ?>
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
            'is_own_answer',
            'option_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
