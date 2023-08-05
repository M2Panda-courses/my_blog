<?php declare(strict_types=1);

namespace Panda\Tag\Model;

use Magento\Framework\Model\AbstractModel;
use Panda\Tag\Api\Data\TagPostInterface;

class TagPost extends AbstractModel implements TagPostInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\TagPost::class);
    }

    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }

    public function setPostId($post_id)
    {
        $this->setData(self::POST_ID, $post_id);
    }

    public function getTagId()
    {
        return $this->getData(self::TAG_ID);
    }

    public function setTagId($tag_id)
    {
        $this->setData(self::TAG_ID, $tag_id);
    }
}
