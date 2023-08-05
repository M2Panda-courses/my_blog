<?php declare(strict_types=1);

namespace Panda\Tag\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Tag\Api\Data\TagPostInterface;
use Panda\Tag\Api\Data\TagPostRepositoryInterface;
use \Panda\Tag\Model\ResourceModel\TagPost as TagPostResourceModule;

class TagPostRepository implements TagPostRepositoryInterface
{
    public function __construct(
        private TagPostFactory $tagFactory,
        private TagPostResourceModule $tagResourceModule,
    ){}

    public function getById(int $id): TagPostInterface
    {
        $tagPost = $this->tagFactory->create();
        $this->tagResourceModule->load($tagPost, $id);

        if (!$tagPost->getId()){
            throw new NoSuchEntityException(__('The tagPost entity with "%1" id does not exist', $id));
        }

        return $tagPost;
    }

    public function save(TagPostInterface $tagPost): TagPostInterface
    {
        try{
            $this->tagResourceModule->save($tagPost);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $tagPost;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->tagResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
