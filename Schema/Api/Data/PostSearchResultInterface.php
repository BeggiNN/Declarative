<?php

namespace Perspective\Schema\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;


interface PostSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Perspective\Schema\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * @param \Perspective\Schema\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

