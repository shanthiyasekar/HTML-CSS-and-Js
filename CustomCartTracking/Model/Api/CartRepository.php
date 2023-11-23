<?php

namespace Vendor\CustomCartTracking\Model\Api;

use Magento\Framework\Exception\LocalizedException;
use Vendor\CustomCartTracking\Model\CartFactory as CartModel;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart as CartResource;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart\CollectionFactory;
use Vendor\CustomCartTracking\Api\CartDataInterface;
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
        CartDataInterface $CartDataInterfaceFactory,
        CartModel $model,
        CartResource $resource
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->CartDataInterfaceFactory = $CartDataInterfaceFactory;
        $this->model = $model;
        $this->resource = $resource;
    }
    /**
     * @param int|null $start
     * @param int|null $end
     * @return \Vendor\CustomCartTracking\Api\DataInterface[]
     */
    public function getApiData(int $start = null,int $end=null)
    {
        if ($start == null) {
            $start = 1;
        }
        if ($end == null) {
            $end = 10;
        }
        $data = [];

        //try {
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter(
                'id',
                [
                    'from' => $start,
                    'to' => $end,
                ]
            );
            foreach ($collection as $item) {
                $model1 = $this->model->create();
                $model1->setId($item->getId());
                $model1->setSku($item->getSku());
                $model1->setQuoteId($item->getQuoteId());
                $model1->setCustomerId($item->getCustomerId());
                $model1->setCreated($item->getCreated());
                $data[] = $model1;
            }
            return $data;
        // } catch (LocalizedException $e) {
        //     throw $e;
        // }
    }


    // /**
    //  * @param string $sku
    //  * @param int $quoteId
    //  * @param int $customerId
    //  * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
    //  */
    // public function save(string $sku, int $customerId = null, int $quoteId)
    // {

    //     $model = $this->model->create();
    //     $model->setSku($sku);
    //     $model->setQuoteId($quoteId);
    //     $model->setCustomerId($customerId);

    //     try {
    //         $this->resource->save($model);
    //         $response = ['success' => 'Saved Successfully'];
    //         return $response;
    //     } catch (LocalizedException $e) {
    //         throw $e;
    //     }
    // }

        /**
     * @param CartDataInterface $cart
     * @return CartDataInterface
     * @throws LocalizedException
     */
    public function save(CartDataInterface $cart)
    {
        $trackingProductModel = $this->model->create(); 

        $trackingProductModel->setData($cart->getData());  

        $this->resource->save($trackingProductModel);
        // clog(get_class($data));
        return $cart;
    }

    /**
     * @param int $id
     * @return \Vendor\CustomCartTracking\Api\DataInterface[]
     */

    public function getById(int $id)
    {
        try {
            if ($id) {
                $collection = $this->collectionFactory->create();
                $data = $collection->addFieldToFilter('id', $id)->getData();
                return $data;
            }
        } catch (LocalizedException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
 * @param CartDataInterface $cart
 * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
 * @throws LocalizedException
 */
public function update(CartDataInterface $cart)
{
    $model1 = $this->model->create();
    $this->resource->load($model1, $cart->getId(), 'id');

    if (!$model1->getData()) {
        return ['success' => 'ID is not Available'];
    }

    $model1->setData($cart->getData());

    try {
        $this->resource->save($model1);
        return ['success' => 'Updated Successfully'];
    } catch (LocalizedException $e) {
        throw $e;
    }
}


    // /**
    //  * @param string $id
    //  * @param string $sku
    //  * @param int $quoteId
    //  * @param int $customerId
    //  * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
    //  */
    // public function update(int $id, string $sku, int $quoteId = null, int $customerId = null)
    // {


    //     $model = $this->model->create();
    //     $this->resource->load($model, $id, 'id');
    //     if (!$model->getData()) {
    //         return ['success' => 'ID is not Available'];
    //     }
    //     if ($sku != null) {
    //         $model->setSku($sku);
    //     }

    //     if ($quoteId != null) {
    //         $model->setQuoteId($quoteId);
    //     }

    //     if ($customerId != null) {
    //         $model->setCustomerId($customerId);
    //     }


    //     try {
    //         $this->resource->save($model);
    //         return ['success' => 'Updated Successfully'];
    //     } catch (LocalizedException $e) {
    //         throw $e;
    //     }
    // }


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
