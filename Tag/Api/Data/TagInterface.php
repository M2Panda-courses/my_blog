<?php declare(strict_types=1);

namespace Panda\Tag\Api\Data;

/**
 * Tag interface.
 */
interface TagInterface
{
    const ID = 'id';
    const CREATED_AT = 'created_at';
    const NAME = 'name';
    const POPULARITY = 'popularity';

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
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getPopularity();

    /**
     * @param int $popularity
     * @return $this
     */
    public function setPopularity($popularity);

}
