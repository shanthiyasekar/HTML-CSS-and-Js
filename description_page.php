<?php 
include ("includes/connect.php");
include ("functions/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommmerce websit usin php and mysql</title>
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
                    <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup><?php
                    $d->cart_item_number();?></sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Total Price:<?php 
                    $d->total_cart_price();?>/-</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0" action="search_product.php" method="get">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                  <!-- <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button> -->
                  <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
              </form>
            </div>
        </nav>
       
        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden store</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nesciunt </p>
        </div>
        <?php
        $d->cart();
      ?>
     

        <div class="row px-3">
          <div class="col-md-10">
            <!-- products -->
            <div class="row">
              <!-- fetching products -->
              <?php
                  $d->view_details();
              ?>
            </div>
          </div>
        </div> 
       
        <!-- last child -->
        <?php 
            include "./includes/footer.php";
        ?>
    </div>
 
         
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>