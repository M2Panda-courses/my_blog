<?php declare(strict_types=1);

namespace Panda\Tag\Api\Data;

/**
 * Tag interface.
 */
interface TagPostInterface
{
    const ID = 'id';
    const POST_ID = 'post_id';
    const TAG_ID = 'tag_id';

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
    public function getPostId();

    /**
     * @param string $post_id
     * @return $this
     */
    public function setPostId($post_id);

    /**
     * @return int
     */
    public function getTagId();

    /**
     * @param int $tag_id
     * @return $this
     */
    public function setTagId($tag_id);

}
