<?php declare(strict_types=1);

namespace Panda\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Blog\Api\Data\PostInterface;
use Panda\Blog\Api\Data\PostRepositoryInterface;
use \Panda\Blog\Model\ResourceModel\Post as PostResourceModule;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(
        private PostFactory $postFactory,
        private PostResourceModule $postResourceModule,
    ){}

    public function getById(int $id): PostInterface
    {
        $post = $this->postFactory->create();
        $this->postResourceModule->load($post, $id);

        if (!$post->getId()){
            throw new NoSuchEntityException(__('The blog post with "%1" id does not exist', $id));
        }

        return $post;
    }

    public function save(PostInterface $post): PostInterface
    {
        try{
            $this->postResourceModule->save($post);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $post;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->postResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
