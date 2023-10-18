<?php

namespace Vendor\CustomCartTracking\Model\Api;

use Magento\Framework\Exception\LocalizedException;
use Vendor\CustomCartTracking\Model\CartFactory as CartModel;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart as CartResource;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart\CollectionFactory;


use Vendor\CustomCartTracking\Api\CartDataInterfaceFactory;
use Vendor\CustomCartTracking\Api\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

    /**
     * @var CartDataInterfaceFactory
     */
    private $CartDataInterfaceFactory;

    /**
     * @var CollectionFactory
     */

    private $collectionFactory;

    /**
     * @var CartModel
     */
    private $model;

    /**
     * @var CartResource
     */

    private $resource;



    public function __construct(
        CollectionFactory $collectionFactory,
        CartDataInterfaceFactory $CartDataInterfaceFactory,
        CartModel $model,
        CartResource $resource
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->CartDataInterfaceFactory = $CartDataInterfaceFactory;
        $this->model = $model;
        $this->resource = $resource;
    }
    /**
     * @param int|null $pageId
     * @return \Vendor\CustomCartTracking\Api\DataInterface[]
     */
    public function getApiData(int $pageId = null)
    {
        if ($pageId === null) {
            $pageId = 1;
        }
        $data = [];

        try {
            $collection = $this->collectionFactory->create()
                ->setPageSize(10)->setCurPage($pageId);

            foreach ($collection as $item) {
                $Productdata = [
                    'id' => $item->getId(),
                    'sku' => $item->getSku(),
                    'quote_id' => $item->getQuoteId(),
                    'customer_id' => $item->getCustomerId(),
                    'created_at' => $item->getCreated(),
                ];
                $data[] = $Productdata;
            }

            return $data;
        } catch (LocalizedException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    /**
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */
    public function save(string $sku, int $customerId = null, int $quoteId)
    {

        $model = $this->model->create();
        $model->setSku($sku);
        $model->setQuoteId($quoteId);
        $model->setCustomerId($customerId);

        try {
            $this->resource->save($model);
            $response = ['success' => 'Saved Successfully'];
            return $response;
        } catch (LocalizedException $e) {
            throw $e;
        }
    }


    /**
     * @param int $id
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */

    public function getById(int $id)
    {
        try {
            if ($id) {
                $model = $this->model->create();
                $this->resource->load($model, $id, 'id');
                return $data = $model->getData();
            }
        } catch (LocalizedException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }



    /**
     * @param string $id
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */
    public function update(int $id, string $sku, int $quoteId = null, int $customerId = null)
    {


        $model = $this->model->create();
        $this->resource->load($model, $id, 'id');
        if (!$model->getData()) {
            return ['success' => 'ID is not Available'];
        }
        if ($sku != null) {
            $model->setSku($sku);
        }

        if ($quoteId != null) {
            $model->setQuoteId($quoteId);
        }

        if ($customerId != null) {
            $model->setCustomerId($customerId);
        }


        try {
            $this->resource->save($model);
            return ['success' => 'Updated Successfully'];
        } catch (LocalizedException $e) {
            throw $e;
        }
    }


    /**
     * @param string $id
     * @return \Vendor\CustomCartTracking\Api\DataInterface
     */


    public function delete(int $id)
    {
        $model = $this->model->create();
        $this->resource->load($model, $id, 'id');

        if (!$model->getData()) {
            return ['success' => 'ID is not Available'];
        }
        try {

            $this->resource->delete($model);
            return ['success' => true, 'message' => "Deleted Successfully"];
        } catch (LocalizedException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
