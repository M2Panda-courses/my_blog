<?php declare(strict_types=1);

namespace Panda\Category\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Panda\Category\Model\Category;
use Panda\Category\Model\ResourceModel\Category as CategoryResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Category::class, CategoryResourceModule::class);
    }
}
