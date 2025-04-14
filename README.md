swgger
======
Yii2 swagger generator

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-swagger "*"
```

or add

```
"fgh151/yii2-swagger": "*"
```

to the require section of your `composer.json` file.


Usage
-----

1. Add module in config and set dirs with annotations

```php
'modules' => [
    'swagger' => [
        'class' => fgh151\swagger\Module::class,
        'sources' => [
            dirname(__DIR__).'/controllers', //here can be aliases, like '@app/controllers'
            dirname(__DIR__).'/models',
        ]
    ],
],
```
2. Add routes

```php
'rules' => [
    '/swagger/doc.json' => 'swagger/swagger/doc',
    '/swagger/ui' => 'swagger/swagger/ui',
],
```

3. Add controller. It can be not useful and has random name, but contain annotations. Example:

```php
<?php

namespace app\controllers;

use OpenApi\Attributes\Info;
use OpenApi\Attributes\OpenApi;
use OpenApi\Attributes\Server;
use yii\web\Controller;

#[OpenApi(
    info: new Info(version: '1.0.0', title: 'Super API title'),
)]
#[Server(url: 'https://api.example.com', description: 'Super API description')]
class SwaggerController extends Controller
{
}
```

4. Add annotations to controllers and models. Example:

```php
class SomeController extends \yii\web\Controller {
    #[Get(path: '/magic', summary: 'Magic API method.')]
    public function someAction() {
       //Magic here
    }
}
```

```php
#[Schema(title: 'MyModel', description: 'Magic mode', properties: [
    new Property(property: 'Id', description: 'Идентификатор', type: 'integer'),
])]
class MyModel extends ActiveRecord
{
}
```

See [annotations](https://zircote.github.io/swagger-php/guide/attributes.html) 
