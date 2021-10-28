<?php

namespace Nvg\Popup\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Nvg\Popup\Api\Model\RequestPriceInterfaceFactory;
use Nvg\Popup\Api\Repository\RequestPriceRepositoryInterface as Repository;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Class Save
 * @package Nvg\Popup\Controller\Index
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
     * @var DateTime
     */
    private $date;

    /**
     * @param Context $context
     * @param RequestPriceInterfaceFactory $model
     * @param Repository $repository
     * @param DateTime $date
     */
    public function __construct
    (
        Context $context,
        RequestPriceInterfaceFactory $model,
        Repository $repository,
        DateTime $date
    ) {
        parent::__construct($context);
        $this->model = $model;
        $this->repository = $repository;
        $this->date = $date;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $post = $this->getRequest()->getPostValue();

        if (!$post) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while sending the message. Contact us if this problem appears more often.')
            );
        }

        try {
            $modelFactory = $this->model->create();
            $post['created'] = $this->date->gmtDate('Y-m-d');
            $modelFactory->setData($post);

            $this->repository->save($modelFactory);
            return $result->setData(
                [
                    'success' => true,
                    'message' => __('You have sent the request'),
                ]
            );
        } catch (LocalizedException $e) {

            return $result->setData(['success' => false]);
        }
    }
}