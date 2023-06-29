<?php

namespace Panda\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\ResultFactory;

/**
 *  Add new post
 */
class AddPost extends \Panda\Blog\Controller\Adminhtml\Post implements HttpGetActionInterface
{
    private const PAGE_TITLE = 'New Post';

    /**
     * Array of actions which can be processed without secret key validation
     *
     * @var array
     */
    protected $_publicActions = ['add'];

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Panda\Blog\Model\PostFactory
     */
    private $postFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Panda\Blog\Controller\Adminhtml\Post\Builder $postBuilder
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Panda\Blog\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Panda\Blog\Controller\Adminhtml\Post\Builder $postBuilder,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Panda\Blog\Model\PostFactory $postFactory,
    ) {
        parent::__construct($context, $postBuilder);
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
    }

    /**
     * Add new post form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postId = (int) $this->getRequest()->getParam('id');
        $postData = $this->postFactory->create();

        if ($postId) {
            $postData = $postData->load($postId);
            $postTitle = $postData->getTitle();
            if (!$postData->getId()) {
                $this->messageManager->addError(__('post data no longer exist.'));
                $this->_redirect('blog/config/details');
                return;
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $postId ? __('Edit Post Data ').$postTitle : self::PAGE_TITLE;
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
