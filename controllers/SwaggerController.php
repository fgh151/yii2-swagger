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
        $src = array_map(function ($item) {
            return \Yii::getAlias( $item);
        }, $this->module->sources);

        $openapi = Generator::scan($src);

        $this->asJson(Json::decode($openapi->toJson()));
    }

    public function actionUi()
    {
        return $this->render('index', [
            'restUrl' => Url::to(['/swagger/swagger/doc']),
        ]);
    }
}