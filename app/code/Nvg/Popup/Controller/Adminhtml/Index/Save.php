<?php

namespace Nvg\Popup\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Nvg\Popup\Api\Model\RequestPriceInterfaceFactory;
use Nvg\Popup\Api\Repository\RequestPriceRepositoryInterface as Repository;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Save
 * @package Nvg\Popup\Controller\Adminhtml\Index
 */
class Save extends Action
{
    /**
     * @var RequestPriceInterfaceFactory
     */
    private $model;

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param Context $context
     * @param RequestPriceInterfaceFactory $model
     * @param Repository $repository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct
    (
        Context $context,
        RequestPriceInterfaceFactory $model,
        Repository $repository,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->model = $model;
        $this->repository = $repository;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if (!empty($data)) {
            $model = $this->model->create();
            $id = $this->getRequest()->getParam('id');

            if (!empty($id)) {
                try {
                    $model = $this->repository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This item does not exists.'));
                    $resultRedirect->setPath('*/*/index');
                }
            } else {
                $data['id'] = null;
            }
            $model->setData($data);

            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the item.'));
            } catch (CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
            $this->dataPersistor->set('request', $data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        return $resultRedirect->setPath('*/*/index');
    }
}