<?php declare(strict_types=1);

namespace Panda\Blog\Controller\Adminhtml\Post;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Panda\Blog\Api\Data\PostRepositoryInterface;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private PostRepositoryInterface $postRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Panda\Blog\Api\Data\PostRepositoryInterface $postRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, PostRepositoryInterface $postRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->postRepository = $postRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute(): Redirect
    {
        $id = (int) $this->getRequest()->getParam('id');

        $this->postRepository->deleteById($id);
        $this->messageManager->addSuccessMessage(__('Successfully deleted'));

        return $this->resultRedirectFactory->create()->setPath('blog/config/details');
    }
}
