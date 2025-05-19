<?php /** @noinspection PhpUnused */

namespace fgh151\swagger\controllers;

use fgh151\swagger\Module;
use OpenApi\Generator;
use Yii;
use yii\base\InvalidConfigException;
use yii\caching\CacheInterface;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

/**
 * @property Module $module
 */
class SwaggerController extends Controller
{
    /**
     * @throws InvalidConfigException
     */
    public function actionDoc(): Response
    {
        if ($this->module->enableCache) {
            /** @var CacheInterface $cache */
            $cache = is_string($this->module->cache) ? Yii::$app->get($this->module->cache) : $this->module->cache;

            if ($cache === null) {
                throw new InvalidConfigException('The "cache" property must be set.');
            }

            $json= $cache->getOrSet('swagger-doc', function () {
                return $this->parseAnnotations();
            }, $this->module->cacheDuration);
            $this->asJson(Json::decode($json));
        }

        return $this->asJson(Json::decode($this->parseAnnotations()));
    }

    public function actionUi(): string
    {
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('index', [
            'restUrl' => Url::to([$this->module->schema]),
        ]);
    }

    private function parseAnnotations(): string
    {
        $src = array_map(function ($item) {
            return Yii::getAlias( $item);
        }, $this->module->sources);

        $openapi = Generator::scan($src);

        return $openapi->toJson();
    }
}