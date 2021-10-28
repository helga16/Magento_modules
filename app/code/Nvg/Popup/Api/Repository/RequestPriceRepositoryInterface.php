<?php

namespace Nvg\Popup\Api\Repository;

use Nvg\Popup\Api\Model\RequestPriceInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Interface RequestPriceRepositoryInterface
 * @package Nvg\Popup\Api\Repository
 */
interface RequestPriceRepositoryInterface
{
    /**
     * @param int $id
     * @throws NoSuchEntityException
     * @return RequestPriceInterface
     */
    public function getById(int $id) : RequestPriceInterface;

    /**
     * @return array
     */
    public function getList() : array;

    /**
     * @param RequestPriceInterface $requestPrice
     * @throws CouldNotSaveException
     * @return RequestPriceInterface
     */
    public function save(RequestPriceInterface $requestPrice) : RequestPriceInterface;

    /**
     * @param RequestPriceInterface $requestPrice
     * @return RequestPriceRepositoryInterface
     */
    public function delete(RequestPriceInterface $requestPrice) : RequestPriceRepositoryInterface;

    /**
     * @param int $id
     * @return RequestPriceRepositoryInterface
     */
    public function deleteById(int $id) : RequestPriceRepositoryInterface;
}