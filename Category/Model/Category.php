<?php declare(strict_types=1);

namespace Panda\Category\Model;

use Magento\Framework\Model\AbstractModel;
use Panda\Category\Api\Data\CategoryInterface;

class Category extends AbstractModel implements CategoryInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Category::class);
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

}
