<?php

use yii\helpers\Html;

?>

<div class="container">

	<div class="col-one">
        <div class="questionary__inner">
            <h2 class="questionary__title title"><?= Yii::t('common', 'Сауалнамалар') ?></h2>
            <div class="questionary__list">
            	<?php foreach ( $categories as $category ) : ?>
					<?= Html::a((Yii::$app->language == 'kk') ? $category->name_kaz : $category->name_rus, ['index', 'category_id' => $category->id], ['class' => 'questionary__items']) ?>
			    <?php endforeach; ?>
			</div>
        </div>
    </div>

</div>