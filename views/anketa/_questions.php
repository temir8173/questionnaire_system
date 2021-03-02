<?php 

$index = 0; 
$c_count = count($questions);
$c_num = 1;
foreach ($questions as $category) : ?>

    <?php if ( $c_count > 1 ) : ?>
        <h4>
            <span class="num__span"><?= $c_num.') ' ?></span>
            <?= (Yii::$app->language == 'kk') ? $category['name_kaz'] : $category['name_rus'] ?>
        </h4>
    <?php endif; ?>

    <?php foreach ( $category['questions'] as $q_num => $question ) { ?>

        <div class="chosen-check">
        <p>
            <span class="num__span1"><?= ($c_count > 1) ? $c_num.'.'.($q_num+1) : ($q_num+1) ?>) </span>
            <?= (Yii::$app->language == 'kk') ? $question->name_kaz : $question->name_rus ?>
        </p>

        <?= $form->field($resultItems[$index], "[$index]question_id")->hiddenInput(['value' => $question->id])->label(false) ?>
        
        <?php if ( $question->options->is_multiple ) {
            foreach ( $question->items as $option ) { 
                if ($option['type'] !== 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id[]")->checkbox([
                        'label' => (Yii::$app->language == 'kk') ? $option['name_kaz'] : $option['name_rus'], 
                        'value' => ($option['type'] == 'own') ? (-$option['id']) : $option['id'], 
                        'id' => $question->id.'-'.$index.'-'.$option['id'], 
                        'class' => ($option['type'] == 'own') ? 'custom-answer' : '',
                        'uncheck' => null, 
                        'is_own' => ($option['type'] == 'own') ? $question->id.'-'.$option['id'] : 'no' 
                    ]);
                }
                if ($option['type'] == 'own') {
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput(['parent_id' => $question->id.'-'.$option['id'], 'style' => 'display: none;'])->label(false);
                }
            }
        } else {
            foreach ( $question->items as $option ) { 
                if ($option['type'] !== 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id")->radio([
                        'label' => (Yii::$app->language == 'kk') ? $option['name_kaz'] : $option['name_rus'], 
                        'value' => ($option['type'] == 'own') ? (-$option['id']) : $option['id'], 
                        'id' => $question->id.'-'.$index.'-'.$option['id'], 
                        'class' => ($option['type'] == 'own') ? 'custom-answer' : '',
                        'uncheck' => null, 
                        'is_own' => ($option['type'] == 'own') ? $question->id.'-'.$option['id'] : 'no' 
                    ]);
                }
                if ($option['type'] == 'own') {
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput(['parent_id' => $question->id.'-'.$option['id'], 'style' => 'display: none;'])->label(false);
                } elseif ($option['type'] == 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id")->hiddenInput([ 'value' => (-$option['id']) ])->label(false);
                    echo '<div class="slidecontainer">';
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput([
                        'id' => 'myRange',
                        'class' => 'input-percentage int required slider-input',
                        'type' => 'range',
                        'min' => '1',
                        'max' => '100',
                        'value' => '50',
                    ])->label((Yii::$app->language == 'kk') ? $option['name_kaz'] : $option['name_rus']);
                    echo '<p><span id="demo"></span></p>';
                    echo '</div>';
                }
            }
        } ?>
            
        </div>

    <?php $index++; } ?>

<?php $c_num++; endforeach; ?>