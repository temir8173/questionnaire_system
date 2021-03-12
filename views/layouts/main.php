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
use app\widgets\TopMenu\TopMenu;

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
    <?php 
        $variables = array (
            'language' => Yii::$app->language,
            // Тут обычно какие-то другие переменные
        );
        echo '<script type="text/javascript">window.my_data = ' . json_encode($variables) . ';</script>';
    ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= TopMenu::widget(); ?>
    
    <div class="container">
        
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Главная ',
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
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
