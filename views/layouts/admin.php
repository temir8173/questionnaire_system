<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\MultiLang\MultiLang;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo MultiLang::widget(['cssClass'=>'pull-right language']);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'На сайт', 'url' => ['/']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="padding-bottom: 50px;">
        
        <?= Alert::widget() ?>
    </div>
    <div class="container" style="padding-top: 0; width: 100%"> 
        
        <div class="col-md-2">
            
            <ul class="admin-menu nav">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle event" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-briefcase"></i> Университет<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Институты', ['institut/index'], ['class' => '']) ?></li>
                        <li><?= Html::a('Высшие школы', ['school/index'], ['class' => '']) ?></li>
                        <li><?= Html::a('Дисциплины', ['subject/index'], ['class' => '']) ?></li>
                        <li><?= Html::a('Преподаватели', ['teacher/index'], ['class' => '']) ?></li>
                        <li><?= Html::a('Учебные программы', ['program/index'], ['class' => '']) ?></li>
                        <li><?= Html::a('Группы', ['group/index'], ['class' => '']) ?></li>
                    </ul>
                </li>
                
                <li><?= Html::a('Анкеты', ['anketa/index'], ['class' => '']) ?></li>
                <li><?= Html::a('Категории анкет', ['anketa-category/index'], ['class' => '']) ?></li>
                <li><?= Html::a('Варианты ответов (общие)', ['options/index'], ['class' => '']) ?></li>
                <li><?= Html::a('Результаты анкетирования', ['results/index'], ['class' => '']) ?></li>
            </ul>
        </div>
        <div class="col-md-10">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Админ панель',
                    'url' => ['/admin'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Homework <?= date('Y') ?></p>

        
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
