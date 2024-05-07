<?php

namespace fgh151\swagger;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public array $sources = [];

    public function init()
    {
        $this->controllerNamespace = 'fgh151\swagger\controllers';
        parent::init();
    }
}