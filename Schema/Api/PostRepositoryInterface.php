<?php

namespace Perspective\Schema\Api;

use Perspective\Schema\Api\Data\PostInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface PostRepositoryInterface
 * @package AlexPoletaev\Api
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return \Perspective\Schema\Api\Data\PostInterface
     */
    public function get(int $id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Perspective\Schema\Api\Data\PostSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Perspective\Schema\Api\Data\PostInterface $post
     * @return \Perspective\Schema\Api\Data\PostInterface
     */
    public function save(PostInterface $post);

    /**
     * @param \Perspective\Schema\Api\Data\PostInterface $post
     * @return bool
     */
    public function delete(PostInterface $post);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);
}

