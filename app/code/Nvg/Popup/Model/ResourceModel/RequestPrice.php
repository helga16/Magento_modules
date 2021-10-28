<?php

namespace Nvg\Popup\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class RequestPrice
 *  @package Nvg\Popup\Model\ResourceModel
 */
class RequestPrice extends AbstractDb
{
    /**
     * Standard resource model initialization.
     */
    public function _construct()
    {
        $this->_init('requests_for_prices', 'id');
    }
}