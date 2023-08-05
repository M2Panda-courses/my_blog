<?php declare(strict_types=1);

namespace Panda\Tag\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Panda\Tag\Api\Data\TagInterface;
use Panda\Tag\Api\Data\TagRepositoryInterface;
use \Panda\Tag\Model\ResourceModel\Tag as TagResourceModule;

class TagRepository implements TagRepositoryInterface
{
    public function __construct(
        private TagFactory $tagFactory,
        private TagResourceModule $tagResourceModule,
    ){}

    public function getById(int $id): TagInterface
    {
        $tag = $this->tagFactory->create();
        $this->tagResourceModule->load($tag, $id);

        if (!$tag->getId()){
            throw new NoSuchEntityException(__('The tag with "%1" id does not exist', $id));
        }

        return $tag;
    }

    public function save(TagInterface $tag): TagInterface
    {
        try{
            $this->tagResourceModule->save($tag);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $tag;
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
