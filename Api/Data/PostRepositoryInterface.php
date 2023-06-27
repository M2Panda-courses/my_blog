<?php declare(strict_types=1);

namespace Panda\Blog\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Blog\Api\Data\PostInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Blog post CRUD interface.
 * @api
 * @since 1.0.0
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getById(int $id): PostInterface;

    /**
     * @param PostInterface $post
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
