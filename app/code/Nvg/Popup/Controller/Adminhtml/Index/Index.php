<?php
namespace Nvg\Popup\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Index
 * @package Nvg\Popup\Controller\Adminhtml\Index
 */
class Index extends Action
{
    /**
     * @return ResultInterface
     */
    public function execute() :ResultInterface
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->getConfig()->getTitle()->prepend(__('Requested Price Orders'));

        return $page;
    }

    /**
     * @return bool
     */
    protected function _isAllowed() :bool
    {
        return $this->_authorization->isAllowed('Nvg_Popup::managers_requested_prices_access');
    }
}