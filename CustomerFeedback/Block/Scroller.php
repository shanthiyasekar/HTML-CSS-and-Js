<?php

namespace Vendor1\CustomerFeedback\Block;

use Magento\Framework\View\Element\Template;
use Vendor1\CustomerFeedback\Model\ResourceModel\Feedback\CollectionFactory;

class Scroller extends Template
{
    protected $feedbackCollectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $feedbackCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->feedbackCollectionFactory = $feedbackCollectionFactory;
    }

    public function getApprovedcomment()
    {
        $collection = $this->feedbackCollectionFactory->create();
        $collection->addFieldToFilter('status', 1);
        $collection->setPageSize(5); // Adjust the number of feedback items to display
        return $collection;
    }
}