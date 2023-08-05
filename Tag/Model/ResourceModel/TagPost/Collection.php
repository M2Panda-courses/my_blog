<?php declare(strict_types=1);

namespace Panda\Tag\Model\ResourceModel\TagPost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Panda\Tag\Model\TagPost;
use Panda\Tag\Model\ResourceModel\TagPost as TagPostResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(TagPost::class, TagPostResourceModule::class);
    }
}
