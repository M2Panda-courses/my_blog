<?php

namespace Panda\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ObjectManager;

/**
 *  Edit post
 */
class Edit extends \Panda\Blog\Controller\Adminhtml\Post implements HttpGetActionInterface
{
    private const PAGE_TITLE = 'Post';

    /**
     * Array of actions which can be processed without secret key validation
     *
     * @var array
     */
    protected $_publicActions = ['edit'];

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Panda\Blog\Controller\Adminhtml\Post\Builder $postBuilder
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Panda\Blog\Controller\Adminhtml\Post\Builder $postBuilder,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    ) {
        parent::__construct($context, $postBuilder);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Product edit form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postId = (int) $this->getRequest()->getParam('id');
        $post = $this->postBuilder->build($this->getRequest());

        if ($postId && !$post->getId()) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__('This post doesn\'t exist.'));
            return $resultRedirect->setPath('blog/config/details');
        } elseif ($postId === 0) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__('Invalid post id. Should be numeric value greater than 0'));
            return $resultRedirect->setPath('blog/config/details');
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(self::PAGE_TITLE);
        $resultPage->getConfig()->getTitle()->prepend($post->getTitle());

        return $resultPage;
    }
}
