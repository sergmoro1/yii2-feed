<?php
namespace sergmoro1\feed\controllers;

use Yii;

class FeedController extends \yii\web\Controller
{
    /**
     * @return array chanel definition
     */
    public function channel()
    {
        return [];
    }

    /**
     * @return array pages definition
     */
    public function pages()
    {
        return [];
    }

    /**
     * @return array dataProviters definition
     */
    public function providers()
    {
        return [];
    }

    public function actionIndex()
    {
        $cachePath = Yii::$app->runtimePath.DIRECTORY_SEPARATOR.$this->cacheFilename;

        if ($this->channel())
        {
            if (empty($this->cacheDuration) || !is_file($cachePath) || filemtime($cachePath) < time() - $this->cacheDuration)
            {
                $this->layout = false;
                
                $xml = $this->render('index', [
                    'channel'   => $this->channel(),
                    'pages'     => $this->pages(),
                    'providers' => $this->providers(),
                ]);
                file_put_contents($cachePath, $xml);
            } else {
                $xml = file_get_contents($cachePath);
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            Yii::$app->getResponse()->getHeaders()->set('Content-Type', 'text/xml; charset=utf-8');
            return $xml;
        }
    }
}
