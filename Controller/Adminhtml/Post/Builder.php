<?php
declare(strict_types=1);

namespace Panda\Blog\Controller\Adminhtml\Post;

use Panda\Blog\Api\Data\PostInterface;
use Panda\Blog\Model\PostFactory;
use Magento\Cms\Model\Wysiwyg as WysiwygModel;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreFactory;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Registry;
use Panda\Blog\Api\Data\PostRepositoryInterface;
use Panda\Blog\Model\Post;
//use Panda\Blog\Model\Product\Type as ProductTypes;

/**
 * Build a product based on a request
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Builder
{
    /**
     * @var \Panda\Blog\Model\PostFactory
     */
    protected $postFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Constructor
     *
     * @param PostFactory $postFactory
     * @param Logger $logger
     * @param PostRepositoryInterface|null $postRepository
     */
    public function __construct(
        PostFactory $postFactory,
        Logger $logger,
        PostRepositoryInterface $postRepository = null
    ) {
        $this->postFactory = $postFactory;
        $this->logger = $logger;
        $this->$postRepository = $postRepository ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(PostRepositoryInterface::class);
    }

    /**
     * Build product based on user request
     *
     * @param RequestInterface $request
     * @return PostInterface
     * @throws \RuntimeException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function build(RequestInterface $request): PostInterface
    {
        $postId = (int)$request->getParam('id');

        if ($postId) {
            try {
                $post = $this->postRepository->getById($postId, true);

            } catch (\Exception $e) {
                echo $e->getMessage();
                $this->logger->critical($e);
            }
        }

        return $post;
    }
}
