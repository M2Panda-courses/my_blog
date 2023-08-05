<?php declare(strict_types=1);

namespace Panda\Blog\Setup\Patch\Data;

use Panda\Blog\Api\Data\PostRepositoryInterface;
use Panda\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class PopulateBlogPost implements DataPatchInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private PostFactory $postFactory,
        private PostRepositoryInterface $postRepository,
    ){}


    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $post = $this->postFactory->create();
        $post->setData([
            'thumbnail' => 'dfg',
            'short_text' => 'dfg',
            'categories' => 'dfg',
            'tags' => 'dfg',
            'title' => 'Good post.',
            'content' => 'Very good post.',
            'publish_date' => '08/11/2023 08:13:35'
        ]);
        $this->postRepository->save($post);

        $this->moduleDataSetup->endSetup();
    }
}
