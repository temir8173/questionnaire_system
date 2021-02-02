<?php

/* @var $this yii\web\View */

$this->title = 'Домашнее задание';
?>

<div class="container">

    <div class="chat-container">

    <?php foreach( $messages as $message ) : ?>

        <div class="message-box">
            <div class="mess__author">
                <?= $message['author_id'] ?>
            </div>
            <div class="mess__text">
                <?= $message['message']; ?>
            </div>
        </div>

    <?php endforeach; ?>

    </div>

</div>