<?php

namespace Panda\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class PostBlock extends Template
{
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getItemsPerPage()
    {
        return (int) $this->scopeConfig->getValue(
            'config/general/pagination',
            ScopeInterface::SCOPE_STORE
        );
    }
}
