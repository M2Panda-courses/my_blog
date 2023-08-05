<?php declare(strict_types=1);

namespace Panda\Tag\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Panda\Tag\Api\Data\TagPostInterface;

/**
 * Tag CRUD interface.
 */
interface TagPostRepositoryInterface
{
    /**
     * @param int $id
     * @return TagPostInterface
     * @throws LocalizedException
     */
    public function getById(int $id): TagPostInterface;

    /**
     * @param TagPostInterface $tagPost
     * @return TagPostInterface
     * @throws LocalizedException
     */
    public function save(TagPostInterface $tagPost): TagPostInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
