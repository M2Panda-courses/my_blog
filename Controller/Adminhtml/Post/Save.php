<?php

namespace Panda\Blog\Controller\Adminhtml\Post;

use Panda\Blog\Api\Data\PostRepositoryInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Panda\Blog\Model\PostFactory
     */
    var $postFactory;
    private PostRepositoryInterface $postRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Panda\Blog\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PostRepositoryInterface $postRepository,
        \Panda\Blog\Model\PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = (int) $this->getRequest()->getParam('id');
        if (!$data) {
            $this->_redirect('blog/post/#');
            return;
        }
        try {
            $postData = $this->postFactory->create();
            if (!$data['id']) {
                $data['id'] = null;
            }
            $postData->setData($data);
            $this->postRepository->save($postData);
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
