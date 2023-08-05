<?php declare(strict_types=1);

namespace Panda\Tag\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Panda\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Panda\Tag\Api\Data\TagInterface;
use Panda\Tag\Api\Data\TagRepositoryInterface;
use Panda\Tag\Model\ResourceModel\Tag\Collection;
use Panda\Tag\Model\ResourceModel\TagPost\Collection as TagPostCollection;
use \Magento\Framework\Exception\LocalizedException;

class Tag implements ArgumentInterface
{
    public function __construct(
        private Collection $collection,
        private TagRepositoryInterface $tagRepository,
        private RequestInterface $request,
        private PostCollection $postCollection,
        private TagPostCollection $tagPostCollection,

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

    public function getDetail(): TagInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->tagRepository->getById($id);
    }

    public function getTag($id): TagInterface
    {
    return $this->tagRepository->getById((int) $id);
    }

    public function getPosts(): PostCollection
    {
        $id = (int) $this->request->getParam('id');
        $tagPostList = $this->tagPostCollection->addFieldToFilter('tag_id', $id)->getItems();
        $postIdList = [];
        foreach ($tagPostList as $tagPost) {
            $postIdList[] = $tagPost->getData('id');
        }

        return $this->postCollection->addFieldToFilter('id', ['in' => $postIdList]);

    }
}
