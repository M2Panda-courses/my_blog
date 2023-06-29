<?php
declare(strict_types=1);

namespace Panda\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Panda\Blog\Api\Data\PostRepositoryInterface;
use Panda\Blog\Controller\Adminhtml\Post;
use Panda\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;

/**
 * Class \Magento\Catalog\Controller\Adminhtml\Product\MassDelete
 */
class MassDelete extends Post implements HttpPostActionInterface
{
    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param Builder $postBuilder
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param PostRepositoryInterface|null $postRepository
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        Context $context,
        Builder $postBuilder,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PostRepositoryInterface $postRepository = null,
        LoggerInterface $logger = null
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postRepository = $postRepository ?:
            ObjectManager::getInstance()->create(PostRepositoryInterface::class);
        $this->logger = $logger ?:
            ObjectManager::getInstance()->create(LoggerInterface::class);
        parent::__construct($context, $postBuilder);
    }

    /**
     * Mass Delete Action
     *
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
//        $collection->addMediaGalleryData();

        $postDeleted = 0;
        $postDeletedError = 0;
        /** @var \Panda\Blog\Model\Post $post */
        foreach ($collection->getItems() as $post) {
            try {
                $this->postRepository->deleteById((int)($post->getId()));
                $postDeleted++;
            } catch (LocalizedException $exception) {
                $this->logger->error($exception->getLogMessage());
                $postDeletedError++;
            }
        }

        if ($postDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $postDeleted)
            );
        }

        if ($postDeletedError) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $postDeletedError
                )
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('catalog/*/index');
    }
}
