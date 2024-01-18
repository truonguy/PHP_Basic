<?php 
include('server/connection.php');

//use the search section
if(isset($_POST['search'])){


    //1. detemine page no
    if(isset($_GET['page_no'])&&$_GET['page_no']!=""){
        //if user has already entered page then page number is the one that they
        $page_no = $_GET['page_no'];
    }else{
        //if just entered the page  then default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];

    $price = $_POST['price']; 

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



    
   



//return all products
}else{//1. detemine page no
    if(isset($_GET['page_no'])&&$_GET['page_no']!=""){
        //if user has already entered page then page number is the one that they
        $page_no = $_GET['page_no'];
    }else{
        //if just entered the page  then default page is 1
        $page_no = 1;
    }

    //2. return number of products 
    $stmt1 = $conn->prepare("SELECT COUNT(*) as total_records FROM products");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();



    //3. products per page
    $total_records_per_page = 8;

    $offset = ($page_no-1)*$total_records_per_page;

    $previous_page = $page_no -1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);


    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");

    $stmt2->execute();
    $products = $stmt2->get_result();
 }


?>


<?php 
include('layout/header.php');
?>


<!--Search-->
<div id="full">
    <section id="search" class="left-section ">
        <div class="container py-5">
            <p>Search Products</p>
            <hr>
        </div>

        <form action="shop.php" method="POST">
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <!-- Category selection -->
                    <div class="form-check">
                        <input class="form-check-input" value="shoes" type="radio" name="category" id="category_shoes"
                            <?php if(isset($_POST['search']) && $_POST['category'] == 'shoes') echo 'checked'; ?>>
                        <label class="form-check-label" for="category_shoes">
                            Shoes
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" value="coats" type="radio" name="category" id="category_coats"
                            <?php if((isset($_POST['search']) && $_POST['category'] == 'coats') || !isset($_POST['search'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="category_coats">
                            Coats
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" value="watches" type="radio" name="category"
                            id="category_watches"
                            <?php if(isset($_POST['search']) && $_POST['category'] == 'watches') echo 'checked'; ?>>
                        <label class="form-check-label" for="category_watches">
                            Watches
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" value="bags" type="radio" name="category" id="category_bags"
                            <?php if(isset($_POST['search']) && $_POST['category'] == 'bags') echo 'checked'; ?>>
                        <label class="form-check-label" for="category_bags">
                            Bags
                        </label>
                    </div>

                    <!-- Price range selection -->
                    <div class="row mx-auto container">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>Price</p>
                            <input type="range" class="form-range w-50" name="price"
                                value="<?php if(isset($_POST['price'])) echo $_POST['price']; else echo '100'; ?>"
                                min="1" max="1000" id="customRange2">
                            <div class="w-50">
                                <span style="float: left;">1</span>
                                <span style="float: right;">1000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="form-group my-3 mx-3">
                        <input type="submit" name="search" value="Search" class="btn btn-primary">
                    </div>


                </div>
            </div>

        </form>
    </section>


    <!--Shop-->
    <section id="featured" class="right-section mt-5 my-5 pb-5 ">
        <div class="container text-center py-5">
            <h3>Our Products</h3>
            <hr class="mx-auto" />
            <p>Here you can check out our products</p>
        </div>
        <div class="row list-product mx-auto container-fluid">

            <?php  while($row = $products->fetch_assoc()){ ?>

            <div onclick="window.location.href='single_product.php';"
                class="product text-center col-lg-3 col-md-4 col-sm-12">
                <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>">
                    <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>" />
                </a>
                <div class="start">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="f-name"><?php echo $row['product_name']; ?></p>
                <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                <a href="single_product.php?<?php echo"product_id=". $row['product_id']; ?>">
                    <button class="btn shop-buy-btn">Buy Now</button></a>
            </div>
            <?php } ?>

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
                        <a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a>
                    </li>
                    <?php } ?>


                    <li class=" page-item <?php if($page_no>= $total_no_of_pages){ echo 'disabled'; } ?>">
                        <a class="page-link"
                            href="<?php if($page_no >= $total_no_of_pages){ echo '#' ;}else{ echo "?page_no".($page_no+1); } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
</body>

</html>