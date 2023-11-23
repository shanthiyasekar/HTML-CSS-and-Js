<?php

namespace Vendor\CustomCartTracking\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\CustomCartTracking\Api\CartDataInterface;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart as CartResourceModel;


class Cart extends AbstractModel implements CartDataInterface
{
    protected function _construct()
    {
        $this->_init(CartResourceModel::class); 
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * @param int $id
     * @return $this
     */

    public function setId($id)
    {
         $this->setData('id', $id);
         return $this;
    }
    /**
     * @return string
     */

    public function getSku()
    {
        return $this->getData('sku');
    }

    /**
     * @param string $sku
     * @return $this
     */

    public function setSku($sku)
    {
         $this->setData('sku', $sku);
         return $this;
    }


    /**
     * @return int
     */

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @param string $customerid
     * @return $this
     */

    public function setCustomerId($customerid)
    {
         $this->setData('customer_id', $customerid);
         return $this;
    }

    /**
     * @return int
     */

    public function getQuoteId()
    {
        return $this->getData('quote_id');
    }

    /**
     * @param string $quoteid
     * @return $this
     */

    public function setQuoteId($quoteid)
    {
         $this->setData('quote_id', $quoteid);
         return $this;
    }
    

}