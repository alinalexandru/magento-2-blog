<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Blog
 * @copyright   Copyright (c) 2017 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Blog\Block\Tag;

use Mageplaza\Blog\Block\Frontend;
use Mageplaza\Blog\Helper\Data;

/**
 * Class Widget
 * @package Mageplaza\Blog\Block\Tag
 */
class Widget extends Frontend
{
    /**
     * @return array|string
     */
    public function getTagList()
    {
        return $this->helperData->getTagList();
    }

    /**
     * @param $tag
     * @return string
     */
    public function getTagUrl($tag)
    {
        return $this->helperData->getBlogUrl($tag, Data::TYPE_TAG);
    }

    /**
     * get tags size based on num of post
     * size = (maxSize * (currentItem - min))/(max - min)
     *
     * @param $tag
     * @return float|string
     */
    public function getTagSize($tag)
    {
        $postList = $this->helperData->getPostList();
        if ($postList && is_array($postList)) {
            $max     = count($postList);
            $min     = 1;
            $maxSize = 30;
            $tagPost = $this->helperData->getPostList('tag', $tag->getId());
            if ($tagPost && is_array($tagPost)) {
                $countTagPost = count($tagPost);
                if ($countTagPost <= 1) {
                    return '';
                }

                $size = ($maxSize * ($countTagPost - $min)) / ($max - $min);

                return round($size);
            }
        }

        return '';
    }
}
