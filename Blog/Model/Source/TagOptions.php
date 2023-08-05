<?php declare(strict_types=1);

namespace Panda\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Panda\Tag\Model\ResourceModel\Tag\Collection;

class TagOptions implements OptionSourceInterface
{
    protected Collection $collection;

    /**
     * @param Collection $collection
     */
    public function __construct(
        Collection $collection
    )
    {
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->_getOptions();
    }

    /**
     * @return array
     */
    private function _getOptions(): array
    {
        $optionsArray = [];
        foreach ($this->collection as $option) {
            $optionsArray[] = ['value' => $option->getId(), 'label' => __($option->getId())];
        }
        return $optionsArray;
    }
}
