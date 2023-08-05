<?php declare(strict_types=1);

namespace Panda\Blog\Api\Data;

/**
 * Blog post interface.
 */
interface PostInterface
{
    const ID = 'id';
    const PUBLISH_DATE = 'publish_date';
    const TITLE = 'title';
    const CONTENT = 'content';
    const THUMBNAIL = 'thumbnail';
    const CATEGORIES = 'categories';
    const TAGS = 'tags';
    const SHORT_TEXT = 'short_text';


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getPublishDate();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getThumbnail();

    /**
     * @param string $thumbnail
     * @return $this
     */
    public function setThumbnail($thumbnail);

    /**
     * @return string
     */
    public function getCategories();

    /**
     * @param string $categories
     * @return $this
     */
    public function setCategories($categories);

    /**
     * @return string
     */
    public function getTags();

    /**
     * @param string $tags
     * @return $this
     */
    public function setTags($tags);

    /**
     * @return string
     */
    public function getShortText();

    /**
     * @param string $shortText
     * @return $this
     */
    public function setShortText($short_text);
}
