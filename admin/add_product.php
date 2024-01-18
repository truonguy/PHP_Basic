<?php
session_start();

include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('Location: login.php');
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
                            <a class="nav-link" href="add_new_product.php">
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

                <h2>Create Product</h2>
                <div class="table-responsive">
                    <div class="mx-auto container">
                        <form action="create_product.php" id="create-form" enctype="multipart/form-data" method="POST">
                            <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                            <div class="form-group mt-2">
                                <label>Title</label>
                                <input type="text" class="form-control" id="product-name" name="name"
                                    placeholder="Title">
                            </div>
                            <div class="form-group mt-2">
                                <label>Description</label>
                                <input type="text" class="form-control" id="product-desc" name="description"
                                    placeholder="Description">
                            </div>
                            <div class="form-group mt-2">
                                <label>Price</label>
                                <input type="text" class="form-control" id="product-price" name="price"
                                    placeholder="Price">
                            </div>
                            <div class="form-group mt-2">
                                <label>Special Offer/Sale</label>
                                <input type="text" class="form-control" id="product-offer" name="offer"
                                    placeholder="Sale %">
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
                                <input type="text" class="form-control" id="product-color" name="color"
                                    placeholder="Color" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Image 1</label>
                                <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1"
                                    required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Image 2</label>
                                <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2"
                                    required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Image 1</label>
                                <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3"
                                    required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Image 4</label>
                                <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4"
                                    required>
                            </div>

                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-primary" name="create_product" value="Create">
                            </div>
                        </form>
                    </div>
                </div>






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