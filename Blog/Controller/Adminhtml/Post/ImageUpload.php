<?php

namespace Panda\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class ImageUpload extends Action implements HttpPostActionInterface
{
    private WriteInterface $mediaDirectory;

    public function __construct(
        Context $context,
        Filesystem $filesystem,
        private UploaderFactory $uploaderFactory,
        private StoreManagerInterface $storeManager,
    )
    {
        parent::__construct($context);
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    public function execute(): ResultInterface
    {
        var_dump(111);
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        try {
            $fileUploader = $this->uploaderFactory->create(['fileId' => "thumbnail"]);
            $fileUploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $fileUploader->setAllowRenameFiles(true);
            $fileUploader->setAllowCreateFolders(true);
            $fileUploader->setFilesDispersion(false);

            $imgPath = 'tmp/imageUploader/images';
            $result = $fileUploader->save($this->mediaDirectory->getAbsolutePath($imgPath));

            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
            $fileName = ltrim(str_replace("\\", '/', $result['file']), '/');

            $result['url'] = $mediaUrl . $imgPath . '/' . $fileName;

            return $jsonResult->setData($result);
        } catch (LocalizedException $exception) {
            return $jsonResult->setData(['errorcode' => 0, 'error' => $exception->getMessage()]);
        } catch (\Exception $e) {
            return $jsonResult->setData(['errorcode' => 0, 'error' => 'An error occurred please try again later']);

        }
    }
}
