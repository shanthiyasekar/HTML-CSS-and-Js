<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../sty.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="container">
                <ul class="navbar-list">
                    <li class="nav-item">
                        <a href="" class="nav-link">Welcome guest</a>
                    </li>
                </ul>
            </div> 
        </div>
        <div class="header">
            <h3 class="header-title">Manage Details</h3>
        </div>
        <div class="header">
             <div class="row">
                <div class="col-md-12 bg-secondary">
                    <div class="header-content">
                        <div class="user-profile">
                            <a href="#"><img src="../images/apple.jpg" alt="user_profile" class="admin-image"></a>
                            <p class="text-light text-center">Admin Name</p>
                        </div>
                        <div class="button-container">
                            <button><a href="insert_product.php" class="type">Insert Products</a></button>
                            <button><a href="admin_main.php?insert_category" class="type">Insert Categories</a></button>
                            <button><a href="admin_main.php?insert_brands" class="type">Insert Brands</a></button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3">
    <?php
    if(isset($_GET['insert_category'])) {
        include ('insert_categories.php');
    }
    if(isset($_GET['insert_brands'])) {
        include ('insert_brands.php');
    }
    ?>
</div>
    </div>
    
    
    
    
   
</body>
</html>