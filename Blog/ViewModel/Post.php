<?php declare(strict_types=1);

namespace Panda\Blog\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Theme\Block\Html\Pager;
use Panda\Blog\Api\Data\PostInterface;
use Panda\Blog\Api\Data\PostRepositoryInterface;
use Panda\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\Exception\LocalizedException;
use Panda\Blog\Service\PostsProvider;

class Post implements ArgumentInterface
{
    public function __construct(
        private Collection $collection,
        private PostRepositoryInterface $postRepository,
        private RequestInterface $request,
        private PostsProvider $postsProvider,
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

    /**
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getDetail(): PostInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }

    /**
     * @param int $limit
     * @return Collection
     */
    public function getPosts(int $limit): Collection
    {
        return $this->postsProvider->getPosts($limit, $this->getCurrentPage());
    }

    /**
     * @return int
     */
    public function getCurrentpage(): int
    {
        return (int) $this->request->getParam('p');
    }

    public function getPager(Collection $collection, Pager $pagerBlock): string
    {
        $pagerBlock->setUseConteiner(true)
            ->setShowPerPage(false)
            ->setShowAmount(false)
            ->setFrameLength(3)
            ->setLimit($collection->getPageSize())
            ->setCollection($collection);

        return $pagerBlock->toHtml();

    }
}
