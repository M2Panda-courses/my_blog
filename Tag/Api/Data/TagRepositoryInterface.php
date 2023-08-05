<?php declare(strict_types=1);

namespace Panda\Tag\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Tag\Api\Data\TagInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Tag CRUD interface.
 */
interface TagRepositoryInterface
{
    /**
     * @param int $id
     * @return TagInterface
     * @throws LocalizedException
     */
    public function getById(int $id): TagInterface;

    /**
     * @param TagInterface $tag
     * @return TagInterface
     * @throws LocalizedException
     */
    public function save(TagInterface $tag): TagInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
