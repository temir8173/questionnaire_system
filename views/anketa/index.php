<?php

use yii\helpers\Html;

?>

<div class="container">

	<div class="col-one">
        <div class="questionary__inner">
            <h2 class="questionary__title title"><?= (Yii::$app->language == 'kk') ? $category->name_kaz : $category->name_rus ?></h2>
            <div class="questionary__list">
            	<?php foreach ( $anketas as $anketa ) : ?>
					<?= Html::a((Yii::$app->language == 'kk') ? $anketa->name_kaz : $anketa->name_rus, ['view', 'id' => $anketa->id], ['class' => 'questionary__items']) ?>
			    <?php endforeach; ?>
			</div>
        </div>
    </div>

</div>