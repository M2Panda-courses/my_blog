<?php declare(strict_types=1);

namespace Panda\Tag\Model;

use Magento\Framework\Model\AbstractModel;
use Panda\Tag\Api\Data\TagInterface;

class Tag extends AbstractModel implements TagInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Tag::class);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    public function getPopularity()
    {
        return $this->getData(self::POPULARITY);
    }

    public function setPopularity($popularity)
    {
        $this->setData(self::POPULARITY, $popularity);
    }
}
