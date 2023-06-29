<?php
declare(strict_types=1);

namespace Panda\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;

/**
 * Catalog product controller
 *
 * @api
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class Post extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Panda_Blog::post';

    /**
     * @var Post\Builder
     */
    protected $postBuilder;

    /**
     * @param Action\Context $context
     * @param Post\Builder $postBuilder
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Post\Builder $postBuilder
    ) {
        $this->postBuilder = $postBuilder;
        parent::__construct($context);
    }
}
