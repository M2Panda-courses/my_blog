<?php declare(strict_types=1);

namespace Panda\Blog\Block\Adminhtml\Post\Edit;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

/**
 *
 */
class GenericButton
{
    /**
     * @param UrlInterface $url
     * @param RequestInterface $request
     */
    public function __construct(
        private UrlInterface $url,
        private RequestInterface $request
    ) {}


    /**
     * @return int
     */
    public function getPostId(): int
    {
        return (int) $this->request->getParam('id', 0);
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
