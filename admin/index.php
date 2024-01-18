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
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <span data-feather="shopping-cart"></span>
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
                </div>

                <!-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->

                <h2>Orders</h2>

                <?php 
                if(isset($_GET['order_updated'])){
                ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></p>
                <?php }?>


                <?php
                if(isset($_GET['order_failed'])){
                ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['order_failed']; ?></p>
                <?php }?>


                <?php 
                if(isset($_GET['delete_successfully'])){
                ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['delete_successfully']; ?></p>
                <?php }?>


                <?php
                if(isset($_GET['deleted_failured'])){
                ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failured']; ?></p>
                <?php }?>




                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Order Status</th>
                                <th>User Id</th>
                                <th>Order Date</th>
                                <th>User Phone</th>
                                <th>User Address</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php  foreach($orders as $order ){?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php if($order['order_status']==0){ 
                                    echo "not paid"; 
                                    }elseif($order['order_status']==1){
                                        echo "paid"; 
                                    }elseif($order['order_status']==2){
                                        echo "shipped"; 
                                    }elseif($order['order_status']==3){
                                        echo "delivered"; 
                                    }else {
                                        
                                    } ?></td>
                                <td><?php echo $order['user_id']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['user_phone']; ?></td>
                                <td><?php echo $order['user_address']; ?></td>
                                <td><a href="edit_order.php?order_id=<?php echo $order['order_id'];?>"
                                        class="btn btn-primary">Edit</a></td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>


                            <?php } ?>

                        </tbody>
                    </table>


                    <nav aria-label="Page navigation example" class="mx-auto">
                        <ul class="pagination mt-5 mx-auto">
                            <li class="page-item <?php if($page_no<=1){ echo 'disabled'; } ?>">
                                <a class="page-link"
                                    href="<?php if($page_no <= 1){ echo '#'; }else{ echo "?page_no=".($page_no-1); } ?>">Previous</a>
                            </li>
                            <li class="page-item "><a class="page-link" href="?page_no=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>


                            <?php if ($page_no >= 3) { ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>


                            <li class="page-item">
                                <a class="page-link"
                                    href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a>
                            </li>
                            <?php } ?>


                            <li class=" page-item <?php if($page_no>= $total_no_of_pages){ echo 'disabled'; } ?>">
                                <a class="page-link"
                                    href="<?php if($page_no >= $total_no_of_pages){ echo '#' ;}else{ echo "?page_no=".($page_no+1); } ?>">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
    </script>
</body>

</html>