<?php

namespace Perspective\Schema\Model;

use Perspective\Schema\Api\Data\PostInterface;
use Perspective\Schema\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Post
 * @package Perspective\Schema\Model
 */
class Post extends AbstractModel implements PostInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = PostInterface::ID; //@codingStandardsIgnoreLine

    /**
     * @inheritdoc
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(PostResource::class);
    }

    /**
     * @return int
     */
    public function getName()
    {
        return $this->getData(PostInterface::NAME);
    }

    /**
     * @param int $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setData(PostInterface::NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(PostInterface::TITLE);
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->setData(PostInterface::TITLE, $title);
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(PostInterface::CONTENT);
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->setData(PostInterface::CONTENT, $content);
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(PostInterface::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->setData(PostInterface::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(PostInterface::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(PostInterface::UPDATED_AT, $updatedAt);
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(PostInterface::STATUS);
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status)
    {
        $this->setData(PostInterface::STATUS, $status);
        return $this;
    }
}

