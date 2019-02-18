<?php
namespace sergmoro1\feed\controllers;

class FeedController extends \yii\web\Controller
{
    public function channel()
    {
        return [];
    }

    public function dataProvider()
    {
        return null;
    }

    public function actionIndex()
    {
        $cachePath = \Yii::$app->runtimePath.DIRECTORY_SEPARATOR.$this->cacheFilename;

        if ($this->channel())
        {
            if (empty($this->cacheDuration) || !is_file($cachePath) || filemtime($cachePath) < time() - $this->cacheDuration)
            {
                $this->layout = false;
                
                $xml = $this->render('index', [
                    'channel' => $this->channel(),
                    'dataProvider' => $this->dataProvider(),
                ]);
                file_put_contents($cachePath, $xml);
            } else {
                $xml = file_get_contents($cachePath);
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            \Yii::$app->getResponse()->getHeaders()->set('Content-Type', 'text/xml; charset=utf-8');
            return $xml;
        }
    }
}
