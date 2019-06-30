<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/10/2019
 * Time: 1:57 PM
 */
class Service extends BHBBase
{
    public function getFeatureImage()
    {
        return $this->getPostMeta('service-feature-image');
    }
    public function getSnippet()
    {
        return $this->getPostMeta('service-snippet');
    }
}