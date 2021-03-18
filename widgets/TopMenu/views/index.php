<?php
namespace app\widgets\TopMenu;
use yii\helpers\Html;
use Yii;
?>


<section class="header">
    <div class="container">
        <div class="row">
            <div class="header__inner">
                <div class="header__logo">
                
                    <a href="/">
                        <img height="70" src="http://new.wkau.kz/wp-content/uploads/2020/07/logo.png" class="custom-logo" alt="ЖӘҢГІР ХАН УНИВЕРСИТЕТІ" loading="lazy">
                    </a>
                    <a href="/">
                        <div class="header__logo-title"><?= Yii::t('common', 'ЖӘҢГІР ХАН УНИВЕРСИТЕТІ'); ?>
                            <span><?= Yii::t('common', 'Дәстүр, сапа, жетістік'); ?></span>
                        </div>
                    </a>
                        
                </div>
                <div class="header__lang">
                    <div class="lang__list">
                        <div class="lang__item">
                            <?= Html::a('<img src="/img/kazakhstan.png" alt="">', array_merge(
                                \Yii::$app->request->get(),
                                ['language' => 'kk']
                            )); ?>
                        </div>
                        <div class="lang__item">
                            <?= Html::a('<img src="/img/russia.png" alt="">', array_merge(
                                \Yii::$app->request->get(),
                                ['language' => 'ru']
                            )); ?>
                        </div>
                    </div>  
                </div>
                
            </div>
        </div>
    </div>
</section>