<?php

namespace Perspective\Schema\Model;

use Perspective\Schema\Api\Data\PostInterface;
use Perspective\Schema\Api\Data\PostSearchResultInterface;
use Perspective\Schema\Api\Data\PostSearchResultInterfaceFactory;
use Perspective\Schema\Api\PostRepositoryInterface;
use Perspective\Schema\Model\ResourceModel\Post as PostResource;
use Perspective\Schema\Model\ResourceModel\Post\Collection as PostCollection;
use Perspective\Schema\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Perspective\Schema\Model\PostFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;


class PostRepository implements PostRepositoryInterface
{
    /**
     * @var array
     */
    private $registry = [];

    /**
     * @var PostResource
     */
    private $postResource;

    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * @var PostSearchResultInterfaceFactory
     */
    private $postSearchResultFactory;

    /**
     * @param PostResource $postResource
     * @param PostFactory $postFactory
     * @param PostCollectionFactory $postCollectionFactory
     * @param PostSearchResultInterfaceFactory $postSearchResultFactory
     */
    public function __construct(
        PostResource $postResource,
        PostFactory $postFactory,
        PostCollectionFactory $postCollectionFactory,
        PostSearchResultInterfaceFactory $postSearchResultFactory
    ) {
        $this->postResource = $postResource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->postSearchResultFactory = $postSearchResultFactory;
    }

    /**
     * @param int $id
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id)
    {
        if (!array_key_exists($id, $this->registry)) {
            $post = $this->postFactory->create();
            $this->postResource->load($post, $id);
            if (!$post->getId()) {
                throw new NoSuchEntityException(__('Requested post does not exist'));
            }
            $this->registry[$id] = $post;
        }

        return $this->registry[$id];
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Perspective\Schema\Api\Data\PostSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var PostCollection $collection */
        $collection = $this->postCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        /** @var PostSearchResultInterface $searchResult */
        $searchResult = $this->postSearchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param \Perspective\Schema\Api\Data\PostInterface $post
     * @return PostInterface
     * @throws StateException
     */
    public function save(PostInterface $post)
    {
        try {
            /** @var Post $post */
            $this->postResource->save($post);
            $this->registry[$post->getId()] = $this->get($post->getId());
        } catch (\Exception $exception) {
            throw new StateException(__('Unable to save post #%1', $post->getId()));
        }
        return $this->registry[$post->getId()];
    }

    /**
     * @param \Perspective\Schema\Api\Data\PostInterface $post
     * @return bool
     * @throws StateException
     */
    public function delete(PostInterface $post)
    {
        try {
            /** @var Post $post */
            $this->postResource->delete($post);
            unset($this->registry[$post->getId()]);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove post #%1', $post->getId()));
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->get($id));
    }
}
