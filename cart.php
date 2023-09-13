<?php 
include ("includes/connect.php");
include ("functions/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommmerce website-Cart Details</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-outline-success {
            color: #fff; /* Set the text color to white */
        }
    </style>
</head>
<body>
    
    <!-- navbar -->

    <div class="container-fluid p-0">
      <!-- first child -->
      <nav class="navbar navbar-expand-lg navbar-light bg-info">
     
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link active" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="display_all.php">Products</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Register</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Contact</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
                    cart_item_number();?></sup></a>
                </li>
               
              </ul>
            </div>
      </nav>

      <!-- calling cart function -->
      <?php
        cart();
      ?>
        <!-- second child -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Welcome Guest</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
              </li>
            </ul>
          </div>
      </nav>

      <!-- third child -->
      <div class="bg-light">
            <h3 class="text-center">Hidden store</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nesciunt </p>
      </div>

      <!-- fourth child -->
    <div class="container">
        
        <div class="row">
            <form action="" method="post">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <!-- displaying dynamic data -->
                    <?php 

                         $ip = getIPAddress(); 
                        
                         $cart_query="select * from `cart_details` where ip_address='$ip'";
                         $result_query=mysqli_query($con,$cart_query);
                         while($row=mysqli_fetch_array($result_query)){
                             $product_id=$row['product_id'];
                             $select_products="select * from  `products` where product_id='$product_id'";
                             $result_products=mysqli_query($con,$select_products);
                             while($row_product_price=mysqli_fetch_array( $result_products)){
                                 $product_price=array($row_product_price['product_price']);
                                 $single_product_price=$row_product_price['product_price'];
                                 $product_title=$row_product_price['product_title'];
                                 $product_image1=$row_product_price['product_img1'];

                                 $product_value=array_sum($product_price);
                                 $total+=$product_value;

                    ?>
                    <tr>
                    <td><?php echo $product_id ?></td>
                    <td><?php echo$product_title?></td>
                    <td><img src="./images/<?php echo $product_image1?>" class="cart_img"></td>
                    <td><input type="text" name="quantity" id=""></td>
                    <?php 
                        $ip = getIPAddress(); 
                        if(isset($_POST['update_cart'])){
                            $quantities=$_POST['quantity'];
                            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$ip' and product_id=$product_id";
                            $result_cart=mysqli_query($con,$update_cart);
                            $total=$total*$quantities;
                        }
                    ?>
                    <td><?php echo $single_product_price?></td>
                    
                    <?php
                        }
                    }?>
                </tbody>
            </table>
             <div class="d-flex mb-5">
                <h4 class="px-3 ">SubTotal:<strong class="text-info"><?php echo $total?></strong></h4>
                <input type="submit" class="bg-info px-3 border-0 mb-3 mr-2" name="update_cart"value="update">
                <a href="/ecommerce/index.php"><button class="bg-info px-3 border-0 mb-3">Continue Shopping</button></a>
            </div> 
            
        </div>
    </div>
    </form>
    <!-- last child -->
    <?php 
      include "./includes/footer.php";
    ?>
  </div>
 
         
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>