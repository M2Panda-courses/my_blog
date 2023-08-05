<?php declare(strict_types=1);

namespace Panda\Category\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    const MAIN_TABLE = 'panda_category';
    const ID_FIELD_NAME = 'id';
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
