<?php

declare(strict_types=1);

namespace Panda\Blog\Service;

use Magento\Framework\DB\Select;
use Panda\Blog\Model\ResourceModel\Post\CollectionFactory;
use Panda\Blog\Model\ResourceModel\Post\Collection;

class PostsProvider
{
    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(private CollectionFactory $collectionFactory)
        {
            $this->collectionFactory = $collectionFactory;
        }

    /**
     * @param int $limit
     * @return Collection
     */
    public function getPosts(int $limit, int $currentPage):Collection
    {
        $collection = $this->getCollection();
        $collection->setOrder('id', Select::SQL_DESC);
        $collection->setPageSize($limit);
        $collection->setCurPage($currentPage);
        return $collection;
    }

    /**
     * @return Collection
     */
    private function getCollection(): Collection
    {
        return $this->collectionFactory->create();
    }
}
