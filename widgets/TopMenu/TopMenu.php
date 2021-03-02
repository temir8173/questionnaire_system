<?php

namespace app\widgets\TopMenu;

use yii\helpers\Html;

class TopMenu extends \yii\bootstrap\Widget
{
    public $options = [];
    public function init(){}

    public function run() {

        return $this->render('index', [
            'options' => $this->options,
        ]);

    }
}