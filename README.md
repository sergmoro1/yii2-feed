Xml feed renderer 
=================
RSS or any other feed.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sergmoro1/yii2-feed "*"
```

or add

```
"sergmoro1/yii2-feed": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Needs to inherit FeedController. Should be defined dataProvider() and chanel().
There are ready to use views, but you can make your own.
Copy views to default place and make changes. 
For example for RSS:
```php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use common\models\Post;

class RssController extends FeedController
{
  protected $cacheDuration = 43200;
  protected $cacheFilename = 'rss.xml';
  public function init() {
    parent::init();
    // viewPath by default is '@frontend/views/rss'
    // copy from '@vendor/sergmoro1/yii2-feed/src/views/rss' and change by your own
    $this->setViewPath('@vendor/sergmoro1/yii2-feed/src/views/rss');
  }
  public function dataProvider()
  {
    return new ActiveDataProvider([
      'query' => Post::find()->where([
        'status' => Post::STATUS_PUBLISHED
      ]),
      'sort' => [
        'defaultOrder' => [
          'created_at' => SORT_DESC,
        ],
      ],
    ]);
  }
  public function channel()
  {
    return [
      'title' => Yii::$app->name,
      'description' => 'Notes, code examples. WordPress, Yii.',
      'link' => Url::toRoute('/', true),
      'language' => Yii::$app->language,
      'image' => [
        'url' => Url::to('@web/logo/logo.png', true),
        'title' => Yii::$app->name,
        'link' => Url::to('@web/logo/logo.png', true),
      ],
      'ttl' => 60,
    ];
  }```