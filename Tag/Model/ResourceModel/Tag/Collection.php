<?php declare(strict_types=1);

namespace Panda\Tag\Model\ResourceModel\Tag;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Panda\Tag\Model\Tag;
use Panda\Tag\Model\ResourceModel\Tag as TagResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Tag::class, TagResourceModule::class);
    }
}
