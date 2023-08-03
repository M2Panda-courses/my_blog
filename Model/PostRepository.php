<?php declare(strict_types=1);

namespace Panda\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Blog\Api\Data\PostInterface;
use Panda\Blog\Api\Data\PostRepositoryInterface;
use Panda\Tag\Api\Data\TagRepositoryInterface;
use Panda\Category\Api\Data\CategoryRepositoryInterface;
use \Panda\Blog\Model\ResourceModel\Post as PostResourceModule;
use \Panda\Tag\Model\TagPostFactory;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(
        private PostFactory $postFactory,
        private PostResourceModule $postResourceModule,
        private TagRepositoryInterface $tagRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private TagPostFactory $tagPostFactory,
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
        $new = true;
        if ($post->getId()) {
            $new = false;
        }
        $tags = $post->getTags();
        if (is_array($tags)) {
            $tags = implode(',', $tags);
        }
        $post->setTags($tags);
        try{
            $this->postResourceModule->save($post);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        if ($new) {
            $tags = $post->getTags();
            $tags = explode(',', $tags);
            foreach ($tags as $tag_id) {
                $tag = $this->tagRepository->getById((int)$tag_id);
                $tagPost = $this->tagPostFactory->create();
                $tagPost->setTagId((int) $tag->getId());
                $tagPost->setPostId((int) $post->getId());
                $tagPost->save();
            }
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
