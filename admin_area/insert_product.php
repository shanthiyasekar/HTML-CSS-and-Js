<?php
    include ("../includes/connect.php");

    if(isset($_POST['insert_product'])){
        $product_title=$_POST['product_title'];
        $product_desc=$_POST['description'];
        $product_key=$_POST['product_key'];
        $product_category=$_POST['product_categories'];
        $product_brands=$_POST['product_brands'];
        $product_price=$_POST['product_price'];
        $product_status='true';
        //accessing images
        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];
        
        $tmp_image1=$_FILES['product_image1']['tmp_name'];
        $tmp_image2=$_FILES['product_image2']['tmp_name'];
        $tmp_image3=$_FILES['product_image3']['tmp_name'];

        if($product_title=='' or  $product_desc=='' or $product_key=='' or $product_category=='' or $product_brands=='' or $product_price==''or $product_image1=='' or $product_image2=='' or $product_image3==''){
            echo '<script>alert("please fill all the details")</script>';
        }
        else{
            move_uploaded_file($tmp_image1,"./product_images/$product_image1");
            move_uploaded_file($tmp_image2,"./product_images/$product_image2");
            move_uploaded_file($tmp_image3,"./product_images/$product_image3");

            //insert query
            $insert_query="insert into `products` (product_title,product_desc,product_keywords,category_id,
            brand_id,product_img1,product_img2,product_img3,product_price,date,status) values('$product_title','$product_desc','$product_key','$product_category','$product_brands','$product_image1',
            '$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
            $result=mysqli_query($con,$insert_query);
            if($result)
            {
                echo "<script>alert('sucessfully inserted the products')</script>";
            }
            else{
                echo "<script>alert('not inserted')</script>" ;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link rel="stylesheet" href="/ecommerce/sty.css">
</head>
<body>
    <div class="product_container">
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required>
            </div>
            <!-- description -->
            <div class="form-outline">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" name="description" id="product_description" class="form-control" placeholder="Enter Product Description" autocomplete="off" required>
            </div>
            <!-- product Keyword -->
            <div class="form-outline">
                <label for="product_key" class="form-label">Product Keyword</label>
                <input type="text" name="product_key" id="product_key" class="form-control" placeholder="Enter Product Keyword" autocomplete="off" required>
            </div>

            <!-- categories -->
            <div class="form-outline">
                <label for="product_categories" class="form-label">Select Category</label>
                <select name="product_categories" id="product_categories" class="product_category">
                    <option value="">Select Category</option>
                    <?php
                        $select_category="select * from `categories`";
                        $result=mysqli_query($con,$select_category);
                        while($row=mysqli_fetch_assoc($result)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- brand -->
            <div class="form-outline">
                <label for="product_brand" class="form-label">Select Brand</label>
                <select name="product_brands" id="product_brands" class="product_brand">
                    <option value="">Select Brand</option>
                    <?php
                        $select_brand="select * from `brands`";
                        $result=mysqli_query($con,$select_brand);
                        while($row=mysqli_fetch_assoc($result)){
                            $brand_title=$row['brand_title'];
                            $brand_id=$row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- image1 -->
            <div class="form-outline">
                <label for="product_image1" class="form-label">Product Image1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>
             <!-- image2 -->
             <div class="form-outline">
                <label for="product_image2" class="form-label">Product Image2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required>
            </div>
             <!-- image3 -->
             <div class="form-outline">
                <label for="product_image3" class="form-label">Product Image3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required>
            </div>

            <!-- price -->
            <div class="form-outline">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off" required>
            </div>

            <div class="form-outline">
               <input type="submit" name="insert_product" class="insert_product" value="Insert Product">
            </div>
        </form>
    </div>
</body>
</html>
