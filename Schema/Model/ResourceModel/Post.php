<?php

namespace Perspective\Schema\Model\ResourceModel;

use Perspective\Schema\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 * @package Perspective\Schema\Model\ResourceModel
 */
class Post extends AbstractDb
{
    /**
     * @var string
     */
    const TABLE_NAME = 'perspective_schema_sc_table';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(self::TABLE_NAME, PostInterface::ID);
    }
}
