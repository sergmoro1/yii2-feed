<?php
namespace sergmoro1\feed\interfaces;

interface RssInterface
{
    /**
     * @return string
     */
    public function getTitle();


    /**
     * @return string
     */
    public function getExcerpt();
}
