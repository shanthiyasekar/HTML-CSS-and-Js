<?php

namespace Vendor\CustomCartTracking\Consumer;

use Magento\Framework\Serialize\SerializerInterface;
use Vendor\CustomCartTracking\Model\CartFactory;

class TrackingCart
{
    protected $serializer;

    protected $model;

    /**
     * @param SerializerInterface $serializer
     * @param CartFactory $model
     */

    public function __construct(
        SerializerInterface $serializer,
        CartFactory $model
    ) {
        $this->serializer = $serializer;
        $this->model = $model;
    }

    /**
     * @param $data
     * @return void
     */

    public function consume($data)
    {
        $model = $this->model->create();
        $unserialarr = $this->serializer->unserialize($data);

        try {
            $model->addData($unserialarr)->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}