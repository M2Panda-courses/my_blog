<?php

namespace Panda\Blog\Controller\Adminhtml\Post;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Panda\Blog\Model\PostFactory
     */
    var $postFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Panda\Blog\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Panda\Blog\Model\PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('blog/post/addrow');
            return;
        }
        try {
            $postData = $this->postFactory->create();
            $postData->setData($data);
            if (isset($data['id'])) {
                $postData->setId($data['id']);
            }
            $postData->save();
            $this->messageManager->addSuccess(__('Post data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('blog/config/details');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Panda_Blog::save');
    }
}
