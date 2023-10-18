<?php

namespace Vendor\CustomCartTracking\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart as CartResourceModel;

class Cart extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(CartResourceModel::class); 
    }
}