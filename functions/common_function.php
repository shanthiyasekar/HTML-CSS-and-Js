<?php
include ("./includes/connect.php");


//getting products
function getProducts(){
    global $con;
    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            $select_query="select * from `products` order by rand() limit 0,6";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query))
            {
                $product_id=$row['product_id'];
                
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                $product_image1=$row['product_img1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                    <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='Card image cap'>
                    <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_desc</p>
                    <p>Price:$product_price/-</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info' name='item-name'>Add to cart</a>
                    <a href='description_page.php?product=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                    </div>
                </div>";
            }
        }
    }
}

//getting all products
function getAllProducts(){
    global $con;
    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            $select_query="select * from `products` order by rand()";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query))
            {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                $product_image1=$row['product_img1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                    <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='Card image cap'>
                    <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_desc</p>
                    <p>Price:$product_price/-</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info' name='item-name'>Add to cart</a>
                    <a href='description_page.php?product=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                    </div>
                </div>";
            }
        }
    }
}

//getting unique categories
function get_unique_categories(){
    global $con;
    if(isset($_GET['category']))
    {
            $category_id=$_GET['category'];

            $select_query="select * from `products` where category_id=$category_id";
            $result_query=mysqli_query($con,$select_query);
            $row_no=mysqli_num_rows($result_query);
            if($row_no==0){
                echo "<h2>No Stocks for this category</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query))
            {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                $product_image1=$row['product_img1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                    <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='Card image cap'>
                    <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_desc</p>
                    <p>Price:$product_price/-</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info' name='item-name'>Add to cart</a>
                    <a href='description_page.php?product=$product_id'  class='btn btn-secondary'>View More</a>
                    </div>
                    </div>
                </div>";
            }
        
    }
    
}

//getting unique brands
function get_unique_brands(){
    global $con;
    if(isset($_GET['brand']))
    {
            $brand_id=$_GET['brand'];

            $select_query="select * from `products` where brand_id=$brand_id";
            $result_query=mysqli_query($con,$select_query);
            $row_no=mysqli_num_rows($result_query);
            if($row_no==0){
                echo "<h2>No Stocks for this brand</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query))
            {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                $product_image1=$row['product_img1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                    <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='Card image cap'>
                    <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_desc</p>
                    <p>Price:$product_price/-</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info' name='item-name'>Add to cart</a>
                    <a href='description_page.php?product=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                    </div>
                </div>";
            }
        
    }
    
}
function getBrands()
{
    global $con;
    $select_brands="Select * from `brands`";
    $result_brands=mysqli_query($con,$select_brands);
    
    // echo $row_data['brand_title'];
    while($row_data=mysqli_fetch_assoc($result_brands))
    {
      $brand_title=$row_data['brand_title'];
      $brand_id=$row_data['brand_id'];
      echo "<li class='nav-item'>
      <a href='index.php?brand=$brand_id' class='nav-link text-light'><h4>$brand_title</h4></a>
      </li>";
    }
}
function getCategories()
{
    global $con;
    $select_categories="Select * from `categories`";
    $result_categories=mysqli_query($con,$select_categories);
                  
    // echo $row_data['brand_title'];
    while($row_data=mysqli_fetch_assoc($result_categories))
    {
        $category_title=$row_data['category_title'];
        $category_id=$row_data['category_id'];
        echo "<li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-light'><h4>$category_title</h4></a>
            </li>";
    }
}

//seaching products
function search_products(){
    global $con;
    if(isset($_GET['search_data_product']))
    {
        $search_data=$_GET['search_data'];
        $search_query="select * from `products` where product_keywords like '%$search_data%'";
        
        $result_query=mysqli_query($con,$search_query);
        $row_no=mysqli_num_rows($result_query);
        if($row_no==0)
        {
            echo "<h2>No Stocks for this request</h2>";
        } 
        while($row=mysqli_fetch_assoc($result_query))
        {
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_desc=$row['product_desc'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            $product_image1=$row['product_img1'];
            $product_price=$row['product_price'];
            echo "
            <div class='col-md-4 single-pro-details' style='white-space: normal;'>
                <h2> $product_title</h2>
                <p>$product_desc</p>
                <h4>Rupees: $product_price/-</h4>
                <form action='index.php?add_to_cart=$product_id' method='post'>
                    <div class='form-group'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' id='quantity' name='quantity' value='1' min='1'>
                    </div>
                    <button type='submit' class='btn btn-info' name='add_to_cart'>Add to cart</button>
                </form>
            </div>
            ";
        }
    }
    
}

// view details function
function view_details(){
    global $con;

    if(isset($_GET['product']))
    {
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand']))
            {
                $product_id=$_GET['product'];
                $select_query="select * from `products` where product_id=$product_id";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query))
                {  
                    $product_id=$row['product_id'];
                    $product_title=$row['product_title'];
                    $product_desc=$row['product_desc'];
                    $category_id=$row['category_id'];
                    $brand_id=$row['brand_id'];
                    $product_image1=$row['product_img1'];
                    $product_image2=$row['product_img2'];
                    $product_image3=$row['product_img3'];
                    $product_price=$row['product_price'];
                echo "
                <div class='row'>
                <div class='col-md-4 mb-2 ml-5 mr-5'>
                    <div class='card'>
                        <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='Card image cap'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_desc</p>
                            <!-- Create a new row for product_image2 and product_image3 -->
                            <div class='row'>
                                <div class='col-md-6'>
                                    <img class='card-img-top' src='./admin_area/product_images/$product_image2' alt='Card image cap'>
                                </div>
                                <div class='col-md-6'>
                                    <img class='card-img-top' src='./admin_area/product_images/$product_image3' alt='Card image cap'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4 single-pro-details' style='white-space: normal;'>
                    <h2> $product_title</h2>
                    <p>$product_desc</p>
                    <h4>Rupees: $product_price/-</h4>
                    <div class='form-group'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' id='quantity' name='quantity' value='1' min='1'>
                    </div>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info' name='item-name'>Add to cart</a>
                    
                </div>
            </div>
            
            " 
            ;
            }
            }
        }
    }
}

//getting ip address
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

//cart function
function cart(){

    if(isset($_GET['add_to_cart'])){
        global $con;
        $ip = getIPAddress();  
        $get_product_id=$_GET['add_to_cart'];
      
        $select_query="select * from `cart_details` where ip_address='$ip' and product_id=$get_product_id";
        $result_query=mysqli_query($con,$select_query);
        $row_no=mysqli_num_rows($result_query);
        if($row_no>0)
        {
         //     $update_query = "update `cart_details` set quantity=$quantity where ip_address='$ip' and product_id=$get_product_id";
           // $result_query = mysqli_query($con, $update_query);
            echo "<script>alert('this item is already in the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
           
        }
        else{
            $insert_query="insert into `cart_details`(product_id,ip_address,quantity) values($get_product_id,'$ip',0)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('this item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }

    }
}
//getting the cart item number
function cart_item_number(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $ip = getIPAddress(); 
        $select_query="select * from `cart_details` where ip_address='$ip'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }
    else{
        global $con;
        $ip = getIPAddress(); 
        $select_query="select * from `cart_details` where ip_address='$ip'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

//calcilating the total price 
function total_cart_price(){
    global $con;
    $ip = getIPAddress(); 
    $total=0;
    $cart_query="select * from `cart_details` where ip_address='$ip'";
    $result_query=mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result_query)){
        $product_id=$row['product_id'];
        $select_products="select * from  `products` where product_id='$product_id'";
        $result_products=mysqli_query($con,$select_products);
        while($row_product_price=mysqli_fetch_array( $result_products)){
            $product_price=array($row_product_price['product_price']);
            $product_value=array_sum($product_price);
            $total+=$product_value;
        }
    }
    echo $total;
}
?>