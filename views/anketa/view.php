<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="container">

	<div class="col-one">
        <div class="questionary__inner">

            <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false ] ]]); ?>

                <?php foreach ($results as $index => $result) : ?>

                    <p><?= $questions[$index]->category->id ?></p>
                    <p><?= $questions[$index]['name_rus'] ?></p>

                    <?= $form->field($result, "[$index]language")->hiddenInput(['value' => Yii::$app->language])->label(false) ?>

                    <?php //$options = ArrayHelper::map($questions[$index]->items, 'id', 'name_rus'); ?>

                    <?php if ( $questions[$index]->options->is_multiple ) {
                        foreach ( $questions[$index]->items as $option ) { 
                            echo $form->field($result, "[$index]answer_id")->checkbox(['label' => $option['name_rus'], 'value' => $option['id'], 'uncheck' => null, 'is_own' => ($option['is_own_answer']) ? $option['id'] : '' ]);
                            if ($option['is_own_answer']) {
                                echo $form->field($result, "[$index]answer_id")->textInput(['parent_id' => $option['id']]);
                            }
                        }
                    } else {
                        foreach ( $questions[$index]->items as $option ) { 
                            echo $form->field($result, "[$index]answer_id")->radio(['label' => $option['name_rus'], 'value' => $option['id'], 'uncheck' => null, 'is_own' => ($option['is_own_answer']) ? $option['id'] : 'no' ]);
                            if ($option['is_own_answer']) {
                                echo $form->field($result, "[$index]answer_id")->textInput(['parent_id' => $option['id']])->label(false);
                            }
                        }
                    }
                    
                    ?>

                <?php endforeach; ?>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>

</div>