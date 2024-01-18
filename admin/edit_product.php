<?php
session_start();

include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('Location: login.php');
  exit();
}
?>




<?php

 //1. detemine page no
 if(isset($_GET['page_no'])&&$_GET['page_no']!=""){
    //if user has already entered page then page number is the one that they
    $page_no = $_GET['page_no'];
}else{
    //if just entered the page  then default page is 1
    $page_no = 1;
}

// $category = $_POST['category'];

// $price = $_POST['price']; 

//2. return number of products 
$stmt = $conn->prepare("SELECT COUNT(*) as total_records FROM products WHERE product_category = ? AND product_price <= ?");

$stmt->bind_param('si', $category,$price);

$stmt->execute();

$stmt->bind_result($total_records);

$stmt->store_result();

$stmt->fetch();


 //3. products per page
 $total_records_per_page = 8;

 $offset = ($page_no-1)*$total_records_per_page;

 $previous_page = $page_no -1;
 $next_page = $page_no + 1;

 $adjacents = "2";

 $total_no_of_pages = ceil($total_records/$total_records_per_page);



 //4. get all products
 $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset, $total_records_per_page");
$stmt2->bind_param("si", $category, $price);

$stmt2->execute();
$products = $stmt2->get_result();


        //1. detemine page no
        if(isset($_GET['page_no'])&&$_GET['page_no']!=""){
            //if user has already entered page then page number is the one that they
            $page_no = $_GET['page_no'];
        }else{
            //if just entered the page  then default page is 1
            $page_no = 1;
        }

        //2. return number of products 
        $stmt1 = $conn->prepare("SELECT COUNT(*) as total_records FROM orders");

        $stmt1->execute();

        $stmt1->bind_result($total_records);

        $stmt1->store_result();

        $stmt1->fetch();



        //3. products per page
        $total_records_per_page = 5;

        $offset = ($page_no-1)*$total_records_per_page;

        $previous_page = $page_no -1;
        $next_page = $page_no + 1;

        $adjacents = "2";

        $total_no_of_pages = ceil($total_records/$total_records_per_page);


        //4. get all products
        $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");

        $stmt2->execute();
        $orders = $stmt2->get_result();
        




?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php?logout=1">Sign out</a>
            </li>
        </ul>
    </nav>

    <?php
    if(isset($_GET['product_id'])){ 
        $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id =?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    
    $products = $stmt->get_result(); 
    }elseif(isset($_POST['edit_btn'])){
        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $offer = $_POST['offer'];
        $color = $_POST['color'];
        $category = $_POST['category'];
        $stmt =  $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
        product_special_offer=?, product_color=?, product_category=? WHERE product_id = ?");
        $stmt->bind_param('ssssssi', $title, $description, $price, $offer, $color, $category, $product_id);
        if($stmt->execute()){
        header('location: products.php?edit_success_message=Product has been successfully updated');  
        }else{
        header('location: products.php?edit_failure_message=Error occured, try again');  
        }
    }else{ 
        header("Location:products.php");
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span data-feather=""></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <span data-feather=""></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">
                                <span data-feather="bar-char-2"></span>
                                Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">
                                <span data-feather="users"></span>
                                Add New Product
                            </a>
                        </li>

                    </ul>

                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2"></div>
                    </div>
                </div>
                <h2>Edit Products</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <div class="mx-auto container">
                            <form action="edit_product.php" id="edit-form" method="POST">
                                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                                <div class="form-group mt-2">
                                    <?php foreach($products as $product) {?>
                                    <input type="hidden" name="product_id"
                                        value="<?php echo $product['product_id']; ?>">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" id="product-name" required
                                        value="<?php echo $product['product_name'] ?>" name="title" placeholder="Title">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control" id="product-desc" required
                                        value="<?php echo $product['product_description'] ?>" name="description"
                                        placeholder="Description">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" id="product-price" required
                                        value="<?php echo $product['product_price'] ?>" name="price"
                                        placeholder="Price">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Category</label>
                                    <select class="form-select" aria-label="Default select example" required
                                        name="category">
                                        <option value="bags">Bags</option>
                                        <option value="shoes">Shoes</option>
                                        <option value="watches">Watches</option>
                                        <option value="clothes">Clothes</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Color</label>
                                    <input type="text" class="form-control" id="product-color"
                                        value="<?php echo $product['product_color'] ?>" name="color" placeholder="Color"
                                        required>
                                </div>


                                <div class="form-group mt-2">
                                    <label for="">Sepecial Offer/Sale</label>
                                    <input type="text" class="form-control" id="product-offer"
                                        value="<?php echo $product['product_special_offer'] ?>" name="offer"
                                        placeholder="Sale %" required>
                                </div>



                                <div class="form-group mt-3">
                                    <input type="submit" class="btn btn-primary" name="edit_btn" value="edit">
                                </div>


                                <?php } ?>
                            </form>
                        </div>
                    </table>


                </div>
            </main>
        </div>
    </div>
</body>

</html>