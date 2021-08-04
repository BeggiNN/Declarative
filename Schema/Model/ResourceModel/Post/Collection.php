<?php

namespace Perspective\Schema\Model\ResourceModel\Post;

use Perspective\Schema\Model\Post;
use Perspective\Schema\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Perspective\Schema\Model\ResourceModel\Post
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(Post::class, PostResource::class);
    }
}
