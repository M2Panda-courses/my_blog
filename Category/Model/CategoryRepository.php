<?php declare(strict_types=1);

namespace Panda\Category\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Category\Api\Data\CategoryInterface;
use Panda\Category\Api\Data\CategoryRepositoryInterface;
use \Panda\Category\Model\ResourceModel\Category as CategoryResourceModule;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private CategoryFactory $categoryFactory,
        private CategoryResourceModule $categoryResourceModule,
    ){}

    public function getById(int $id): CategoryInterface
    {
        $category = $this->categoryFactory->create();
        $this->categoryResourceModule->load($category, $id);

        if (!$category->getId()){
            throw new NoSuchEntityException(__('The category with "%1" id does not exist', $id));
        }

        return $category;
    }

    public function save(CategoryInterface $category): CategoryInterface
    {
        try{
            $this->categoryResourceModule->save($category);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $category;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->categoryResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
