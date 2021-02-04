<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HeaderFields */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'К анекете', 'url' => Url::to(['anketa/update', 'id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы о респонденте', 'url' => Url::to(['index', 'anketa_id' => $model->anketa_id])];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="header-fields-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'anketa_id' => $model->anketa_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'anketa_id',
            'type',
            'name_rus',
            'name_kaz',
        ],
    ]) ?>

</div>
