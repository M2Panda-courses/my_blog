<?php declare(strict_types=1);

namespace Panda\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Panda\Blog\Api\Data\PostInterface;

class Post extends AbstractModel implements PostInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Post::class);
    }

    public function getPublishDate()
    {
        return $this->getData(self::PUBLISH_DATE);
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent($content)
    {
        $this->setData(self::CONTENT, $content);
    }

    public function getThumbnail()
    {
        return $this->getData(self::THUMBNAIL);
    }

    public function setThumbnail($thumbnail)
    {
        $this->setData(self::THUMBNAIL, $thumbnail);
    }

    public function getCategories()
    {
        return $this->getData(self::CATEGORIES);
    }

    public function setCategories($categories)
    {
        $this->setData(self::CATEGORIES, $categories);
    }

    public function getTags()
    {
        return $this->getData(self::TAGS);
    }

    public function setTags($tags)
    {
        $this->setData(self::TAGS, $tags);
    }

    public function getShortText()
    {
        return $this->getData(self::SHORT_TEXT);
    }

    public function setShortText($short_text)
    {
        $this->setData(self::SHORT_TEXT, $short_text);
    }
}
