<?php declare(strict_types=1);

namespace Panda\Category\Api\Data;

/**
 * category interface.
 */
interface CategoryInterface
{
    const ID = 'id';
    const CREATED_AT = 'created_at';
    const NAME = 'name';

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

}
