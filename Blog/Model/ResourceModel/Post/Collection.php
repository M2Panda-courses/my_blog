<?php declare(strict_types=1);

namespace Panda\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Panda\Blog\Model\Post;
use Panda\Blog\Model\ResourceModel\Post as PostResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModule::class);
    }
}
