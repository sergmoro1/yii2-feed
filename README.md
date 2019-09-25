Yii2 xml feed renderer
====================== 

RSS or any other feed like yandex turbo-pages.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sergmoro1/yii2-feed
```

or add

```
"sergmoro1/yii2-feed": "~1.0"
```

to the require section of your `composer.json` file.

Usage
-----

Needs to inherit RssController. Should be defined `providers()` and `chanel()`.
There are ready to use views, but you should make your own.
Copy views to default place and make changes. 

For example for RSS.

```php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use common\models\Post;

class RssController extends \sergmoro1\feed\controllers\RssController
{
    public function providers()
    {
        $providers = [];
        $providers['_view'] = new ActiveDataProvider([
            'query' => Post::find()->where([
                'status' => Post::STATUS_PUBLISHED
            ]),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);
        return $providers;
    }

    public function channel()
    {
        return [
            'title' => Yii::$app->name,
            'description' => 'Programmer\'s notes, code examples. WordPress, Yii.',
            'link' => Url::toRoute('/', true),
            'language' => Yii::$app->language,
            'image' => [
                'url' => Url::to('@web/logo/logo.png', true),
                'title' => Yii::$app->name,
                'link' => Url::to('@web/logo/logo.png', true),
            ],
            'ttl' => 60,
        ];
    }
}
```
