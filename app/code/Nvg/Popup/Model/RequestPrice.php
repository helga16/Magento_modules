<?php

namespace Nvg\Popup\Model;

use Magento\Framework\Model\AbstractModel;
use Nvg\Popup\Api\Model\RequestPriceInterface;
use Nvg\Popup\Model\ResourceModel\RequestPrice as ResourceModel;

/**
 * Class RequestPrice
 *  @package Nvg\Popup\Model
 */
class RequestPrice extends AbstractModel implements RequestPriceInterface
{
    /**
     * Initialize model
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @param $date
     */
    public function setDate($date)
    {
        $this->setData(self::DATE, $date);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->getData(self::STATUS);
    }
}