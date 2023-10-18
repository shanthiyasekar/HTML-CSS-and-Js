API & MQ
The following example is the implementation of a tracking client in a Magento 2 backend. Its goal is to store the following, each time a product was added to customer's cart. For guests, just make the customer_id field null.
{
"id": 2, //Autogenerated id i.e primary key
"sku":"ABC123", // SKU that was added to cart
"customer_id":"5",// Customer id or null for Guest
"quote_id": "50", // Customer's quote id
"created": "2022-04-15 07:45:12"// record creation date
}
The above data should be stored in a custom table and should have custom CRUD features along with the ability to control CRUD via REST API.
There should be an API to display all records in the table via Pagination i.e we should be able to define in the API to fetch records from 1 to 10 or 10 to 15 likewise.
Message Queue
This is the second part of the task, where we need to implement Message queues to store the data.
Whenever a customer adds a product to the cart, we should publish the data to be stored in Queue and consume the data from the queue, then store the data in the custom table.
We should have logging wherever necessary to identify any issues in the process.
