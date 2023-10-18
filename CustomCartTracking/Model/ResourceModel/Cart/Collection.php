<?php
namespace Vendor\CustomCartTracking\Model\ResourceModel\Cart;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vendor\CustomCartTracking\Model\Cart as modelCart;
use Vendor\CustomCartTracking\Model\ResourceModel\Cart as resourceModelCart  ;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            modelCart::class,
            resourceModelCart::class
        );
    }

}