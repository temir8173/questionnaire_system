<?php 

$index = 0; 
$c_count = count($questions);
$c_num = 1;
foreach ($questions as $category) : ?>

    <?php if ( $c_count > 1 ) : ?>
        <h4>
            <span class="num__span"><?= $c_num.') ' ?></span>
            <?= $category['name_rus'] ?>
        </h4>
    <?php endif; ?>

    <?php foreach ( $category['questions'] as $q_num => $question ) { ?>

        <div class="chosen-check">
        <p>
            <span class="num__span1"><?= ($c_count > 1) ? $c_num.'.'.($q_num+1) : ($q_num+1) ?>) </span>
            <?= $question->name_rus ?>
        </p>

        <?= $form->field($resultItems[$index], "[$index]question_id")->hiddenInput(['value' => $question->id])->label(false) ?>
        
        <?php if ( $question->options->is_multiple ) {
            foreach ( $question->items as $option ) { 
                if ($option['type'] !== 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id[]")->checkbox([
                        'label' => $option['name_rus'], 
                        'value' => ($option['type'] == 'own') ? (-$option['id']) : $option['id'], 
                        'id' => $question->id.'-'.$index.'-'.$option['id'], 
                        'uncheck' => null, 
                        'is_own' => ($option['type'] == 'own') ? $option['id'] : 'no' 
                    ]);
                }
                if ($option['type'] == 'own') {
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput(['parent_id' => $option['id']])->label(false);
                }
            }
        } else {
            foreach ( $question->items as $option ) { 
                if ($option['type'] !== 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id")->radio([
                        'label' => $option['name_rus'], 
                        'value' => ($option['type'] == 'own') ? (-$option['id']) : $option['id'], 
                        'id' => $question->id.'-'.$index.'-'.$option['id'], 
                        'uncheck' => null, 
                        'is_own' => ($option['type'] == 'own') ? $option['id'] : 'no' 
                    ]);
                }
                if ($option['type'] == 'own') {
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput(['parent_id' => $option['id']])->label(false);
                } elseif ($option['type'] == 'percentage') {
                    echo $form->field($resultItems[$index], "[$index]answer_id")->hiddenInput([ 'value' => (-$option['id']) ])->label(false);
                    echo $form->field($resultItems[$index], "[$index]answer_custom")->textInput(['class' => 'input-percentage int required'])->label($option['name_rus']);
                }
            }
        } ?>
            
        </div>

    <?php $index++; } ?>

<?php $c_num++; endforeach; ?>