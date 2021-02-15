<?php

use yii\helpers\StringHelper;

?>

<option value selected><?= Yii::t('common', '-- Таңдаңыз --') ?></option>

<?php foreach ( $options as $key => $option ) : ?>
	<option value="<?= $key ?>"><?= StringHelper::mb_ucfirst($option) ?></option>
<?php endforeach; ?>