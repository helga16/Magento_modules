<?php

namespace Nvg\Popup\Repository;

use Nvg\Popup\Api\Model\RequestPriceInterface;
use Nvg\Popup\Api\Repository\RequestPriceRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Nvg\Popup\Model\RequestPriceFactory as ModelFactory;
use Nvg\Popup\Model\ResourceModel\RequestPrice as ResourceModel;
use Nvg\Popup\Model\ResourceModel\RequestPrice\CollectionFactory as CollectionFactory;

/**
 * Class RequestPrice
 * @package Nvg\Popup\Repository
 */
class RequestPrice implements RequestPriceRepositoryInterface
{
    /**
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param ModelFactory $modelFactory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ModelFactory $modelFactory,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory
    ) {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param int $id
     * @return RequestPriceInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): RequestPriceInterface
    {
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id);
        if (empty($model->getId())) {
            throw new NoSuchEntityException(__("Item %1 not found", $id));
        }

        return $model;
    }

    /**
     * @param RequestPriceInterface $requestPrice
     * @return RequestPriceInterface
     * @throws CouldNotSaveException
     */
    public function save(RequestPriceInterface $requestPrice): RequestPriceInterface
    {
        try {
            $this->resourceModel->save($requestPrice);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Item could not saved"));
        }

        return $requestPrice;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $collection = $this->collectionFactory->create();

        return $collection->getItems();
    }

    /**
     * @param RequestPriceInterface $requestPrice
     * @return RequestPriceRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(RequestPriceInterface $requestPrice): RequestPriceRepositoryInterface
    {
        try {
            $this->resourceModel->delete($requestPrice);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException("Item is not deleted");
        }

        return $this;
    }

    /**
     * @param int $id
     * @return RequestPriceRepositoryInterface
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): RequestPriceRepositoryInterface
    {
        $model = $this->getById($id);
        $this->delete($model);

        return $this;
    }
}