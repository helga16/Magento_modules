<?php

namespace Nvg\Popup\Model\ResourceModel\RequestPrice;

use Nvg\Popup\Model\RequestPrice as Model;
use Nvg\Popup\Model\ResourceModel\RequestPrice as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Nvg\Popup\Model\ResourceModel\RequestPrice
 */
class Collection extends AbstractCollection
{
    /**
     * Standard resource collection initialization.
     * Initialize model and resource model.
     */
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}