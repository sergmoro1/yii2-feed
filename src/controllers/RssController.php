<?php
namespace sergmoro1\feed\controllers;

class RssController extends FeedController
{
    /**
     * @var int Cache duration, set null to disabled
     */
    protected $cacheDuration = 43200; // default 12 hour

    /**
     * @var string Cache filename
     */
    protected $cacheFilename = 'rss.xml';
}
