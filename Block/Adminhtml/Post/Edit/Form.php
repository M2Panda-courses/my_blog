<?php

namespace Panda\Blog\Block\Adminhtml\Post\Edit;
/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Panda\Blog\Model\PostFactory $postFactory
     */
    public $postFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     * @param \Panda\Blog\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Panda\Blog\Model\PostFactory $postFactory,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->postFactory = $postFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('post_data');

        $model = $this->postFactory->create();
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );
        $form->setHtmlIdPrefix('panda_');

        if(!$model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Post Data'), 'class' => 'fieldset-wide']
            );
        } else {
            try {
                $fieldset = $form->addFieldset(
                    'base_fieldset',
                    ['legend' => __('Edit Post Data'), 'class' => 'fieldset-wide']
                );
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
        $fieldset->addField(
            'short_text',
            'text',
            [
                'name' => 'short_text',
                'label' => __('Short text'),
                'id' => 'short_text',
                'title' => __('Short text'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'thumbnail',
            'text',
            [
                'name' => 'thumbnail',
                'label' => __('Thumbnail'),
                'id' => 'thumbnail',
                'title' => __('Thumbnail'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'categories',
            'text',
            [
                'name' => 'categories',
                'label' => __('Category'),
                'id' => 'categories',
                'title' => __('Category'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'tags',
            'text',
            [
                'name' => 'tags',
                'label' => __('Tags'),
                'id' => 'tags',
                'title' => __('Tags'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'publish_date',
            'date',
            [
                'name' => 'publish_date',
                'label' => __('Publish Date'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'style' => 'width:200px',
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
