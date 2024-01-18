<?php
session_start();

include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('Location: login.php');
  exit();
}
?>

<?php
if(isset($_GET['order_id'])){ 
    $order_id = $_GET['order_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id =?");
$stmt->bind_param("i", $order_id);
$stmt->execute();

$order = $stmt->get_result(); 
}elseif(isset($_POST['edit_order'])){
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    $stmt =  $conn->prepare("UPDATE orders SET order_status=?  WHERE order_id = ?");
    $stmt->bind_param('si', $order_status, $order_id);
    if($stmt->execute()){
    header('location: index.php?order_updated=Order has been successfully updated');  
    }else{
    header('location: index.php?order_failed=Error occured, try again');  
    }
}else{ 
    header("Location:index.php");
    exit();
}






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

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
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
                        <div class="btn-group me-2">

                        </div>
                    </div>
                </div>

                <h2>Edit Order</h2>
                <div class="table-responsive">
                    <div class="mx-auto container">
                        <form id="edit-order-form" method="POST" action="edit_order.php">

                            <?php 
                            foreach($order as $r){
                            ?>

                            <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                            <div class="form-group my-3">
                                <label>OrderId</label>
                                <p class="my-4"><?php echo $r['order_id']; ?></p>
                            </div>

                            <div class="form-group mt-3">
                                <label>OrderPrice</label>
                                <p class="my-4"><?php echo $r['order_cost']; ?></p>
                            </div>


                            <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>">

                            <div class="form-group my-3">
                                <label>Order Status</label>
                                <select name="order_status" class="form-select" required>
                                    <option value="0" <?php if($r['order_status']=='not paid'){ echo "selected";} ?>>
                                        Not Paid
                                    </option>
                                    <option value="1" <?php if($r['order_status']=='paid'){ echo "selected";} ?>>
                                        Paid</option>
                                    <option value="2" <?php if($r['order_status']=='shipped'){ echo "selected";} ?>>
                                        Shipped</option>
                                    <option value="3" <?php if($r['order_status']=='delevered'){ echo "selected";} ?>>
                                        Delevered
                                    </option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label>OrderDate</label>
                                <p class="my-4"><?php echo $r['order_date']; ?></p>
                            </div>


                            <?php }?>

                            <div class="form_group mt-3">
                                <input type="submit" class="btn btn-primary" name="edit_order" value="Edit">
                            </div>

                        </form>
                    </div>
                </div>


            </main>
        </div>
    </div>