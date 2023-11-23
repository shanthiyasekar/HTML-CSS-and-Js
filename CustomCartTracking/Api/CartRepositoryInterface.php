<?php
namespace Vendor\CustomCartTracking\Api;

interface CartRepositoryInterface
{
   /**
     * @param int|null $start
     * @param int|null $end
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */
    public function getApiData(int $start,int $end);


  //  /**
  //    * @param string $sku
  //    * @param int $quoteId
  //    * @param int $customerId
  //    *  @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
  //    */
  //   public function save(string $sku, int $customerId = null, int $quoteId);

  /**
     * Save product data.
     *
     * @param \Vendor\CustomCartTracking\Api\CartDataInterface $cart
     *  @return CartDataInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CartDataInterface $cart);

    
  /**
     * @param int $id
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */
    public function getById(int $id);

    //  /**
    //  * @param string $id
    //  * @param string $sku
    //  * @param int $quoteId
    //  * @param int $customerId
    //  * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
    //  */
    // public function update(int $id, string $sku, int $quoteId, int $customerId = null);

    /**
     * Save product data.
     *
     * @param \Vendor\CustomCartTracking\Api\CartDataInterface $cart
     * @return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
      public function update(CartDataInterface $cart);
  
      /**
     * @param string $id
     *@return \Vendor\CustomCartTracking\Api\CartDataInterface[]
     */

    public function delete(int $id);
}