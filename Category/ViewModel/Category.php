<?php declare(strict_types=1);

namespace Panda\Category\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Panda\Category\Api\Data\CategoryInterface;
use Panda\Category\Api\Data\CategoryRepositoryInterface;
use Panda\Category\Model\ResourceModel\Category\Collection;
use Panda\Blog\Model\ResourceModel\Post\Collection as PostCollection;

class Category implements ArgumentInterface
{
    public function __construct(
        private Collection $collection,
        private CategoryRepositoryInterface $categoryRepository,
        private RequestInterface $request,
        private PostCollection $postCollection,
    ) {}

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->collection->getItems();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->collection->count();
    }

    public function getDetail(): CategoryInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->categoryRepository->getById($id);
    }

    public function getCategory($id): CategoryInterface
    {
        return $this->categoryRepository->getById((int) $id);
    }

    public function getPosts(): PostCollection
    {
        $id = (int) $this->request->getParam('id');
        return $this->postCollection->addFieldToFilter('categories', $id);
    }
}
