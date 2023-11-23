<?php
namespace Vendor\CustomCartTracking\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vendor\CustomCartTracking\Publisher\TrackingCart as Publisher;
use Psr\Log\LoggerInterface;

class TrackingCart implements ObserverInterface
{
    
    private $checkoutSession;
    
    private $publisher;
   
    private $logger;

    /**
     *
     * @param Session $checkoutSession
     * @param Publisher $publisher
     * @param LoggerInterface $logger
     */
    public function __construct(
        Session $checkoutSession,
        Publisher $publisher,
        LoggerInterface $logger
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->publisher = $publisher;
        $this->logger = $logger;
    }

    /**
     * Observe and execute add to cart event
     *
     * @param Observer $observer
     * @return void
     */
    
    public function execute(Observer $observer)
    {
        // dd("hello");
        try {
            $sku = $observer->getProduct()->getSku();   
            $quote = $this->checkoutSession->getQuote();
            $quoteId = $quote->getId();
            $customerId = $quote->getCustomerId();
            $created = $quote->getCreatedAt();
            $data = [
                'sku'         => $sku,
                'customer_id' => $customerId,
                'quote_id'    => $quoteId,
                'created'     => $created
            ];
            $this->logger->info($data['sku']);
            $this->publisher->publish($data);
        } 
        catch (NoSuchEntityException|LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}