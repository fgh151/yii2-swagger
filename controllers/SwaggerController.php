<?php

namespace fgh151\swagger\controllers;

use OpenApi\Generator;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class SwaggerController extends Controller
{
    public function actionDoc()
    {
        $openapi = Generator::scan($this->module->sources);

        $this->asJson(Json::decode($openapi->toJson()));
    }

    public function actionUi()
    {
        return $this->render('index', [
            'restUrl' => Url::to(['/swagger/swagger/doc']),
        ]);
    }
}