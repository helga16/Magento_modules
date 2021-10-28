<?php

namespace Nvg\Popup\DataProvider;

use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use Magento\Framework\App\Request\DataPersistorInterface;
use Nvg\Popup\Api\Model\RequestPriceInterface;
use Nvg\Popup\Model\ResourceModel\RequestPrice\CollectionFactory;

/**
 * Class RequestProvider
 * @package Nvg\Popup\DataProvider
 */
class RequestProvider extends ModifierPoolDataProvider
{
    /**
     * @var array
     */
    private $loadedData = [];

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param DataPersistorInterface $dataPersistor
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * @return array
     */
    public function getData() :array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        /** @var RequestPriceInterface $item */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }
        $data = $this->dataPersistor->get('request');

        if (!empty($data)) {
            $newItem = $this->collection->getNewEmptyItem();
            $newItem->setData($data);
            $this->loadedData[$newItem->getId()] = $newItem->getData();
            $this->dataPersistor->clear('request');
        }

        return $this->loadedData;
    }
}