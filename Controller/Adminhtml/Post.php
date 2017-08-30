<?php

namespace Thesagaydak\News\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Thesagaydak\News\Model\Tag as ThesagaydakPost;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Backend\App\Action\Context;

abstract class Post extends Action
{
    protected $_postFactory;

    protected $_coreRegistry;

    protected $_resultRedirectFactory;

    public function __construct(
        ThesagaydakPost $postFactory,
        Registry $coreRegistry,
        RedirectFactory $resultRedirectFactory,
        Context $context
    )
    {
        $this->_postFactory           = $postFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    protected function _initPost()
    {
        $postId  = (int) $this->getRequest()->getParam('id');
        $post    = $this->_postFactory->create();
        if ($postId) {
            $post->load($postId);
        }
        $this->_coreRegistry->register('thesagaydak_news_post', $post);
        return $post;
    }
}