<?php declare(strict_types=1);

namespace Panda\Blog\Api\Data;

/**
 * Blog post interface.
 * @api
 * @since 1.0.0
 */
interface PostInterface
{
    const ID = 'id';
    const CREATED_AT = 'created_at';
    const TITLE = 'title';
    const CONTENT = 'content';

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
    public function getCreatedAt();

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

}
