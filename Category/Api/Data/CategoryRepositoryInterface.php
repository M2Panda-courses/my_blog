<?php declare(strict_types=1);

namespace Panda\Category\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Category\Api\Data\CategoryInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Category CRUD interface.
 */
interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return CategoryInterface
     * @throws LocalizedException
     */
    public function getById(int $id): CategoryInterface;

    /**
     * @param CategoryInterface $category
     * @return CategoryInterface
     * @throws LocalizedException
     */
    public function save(CategoryInterface $category): CategoryInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
