<?php
namespace Vendor\CustomCartTracking\Api;

interface CartRepositoryInterface
{
   /**
     * @param int|null $pageId
     * @return \Cart\CustomCartTracking\Api\CartDataInterface[]
     */
    public function getApiData(int $pageId = null);


   /**
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     *  @return \Cart\CustomCartTracking\Api\CartDataInterface[]
     */
    public function save(string $sku, int $customerId = null, int $quoteId);


  /**
     * @param int $id
     * @return \Cart\CustomCartTracking\Api\CartDataInterface[]
     */
    public function getById(int $id);

     /**
     * @param string $id
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     * @return \Cart\CustomCartTracking\Api\CartDataInterface[]
     */
    public function update(int $id, string $sku, int $quoteId, int $customerId = null);

  /**
     * @param string $id
     *@return \Cart\CustomCartTracking\Api\CartDataInterface[]
     */

    public function delete(int $id);
}