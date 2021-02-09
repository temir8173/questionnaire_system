<?php

use yii\bootstrap\Html;

if(Yii::$app->language == 'kk') {
	echo Html::a('Перейти на русский', array_merge(Yii::$app->request->get(), [Yii::$app->controller->route, 'language' => 'ru'] ) );
} else {
	echo Html::a('Қазақшаға ауысу', array_merge(Yii::$app->request->get(), [Yii::$app->controller->route, 'language' => 'kk'] ) );
}
