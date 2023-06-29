<?php

namespace Panda\Blog\Block\Adminhtml\Post;
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }
    /**
     * Initialize Imagegallery Images Edit Block.
     */
    protected function _construct()
    {
        $this->_objectId = 'post_id';
        $this->_blockGroup = 'Panda_Blog';
        $this->_controller = 'adminhtml_post';
        parent::_construct();
        if ($this->_isAllowedAction('Panda_Blog::edit_post')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }
    /**
     * Retrieve text for header element depending on loaded image.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Edit Post Data');
    }
    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
