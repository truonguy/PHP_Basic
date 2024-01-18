<?php 
include('layout/header.php');
?>

<!--  Home  -->
<section id="home">
    <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Best Prices</span> This Season</h1>
        <p>Wshop offers the best product for the most affordable princes</p>
        <p class="haha">Wshop offers the best product for the most affordable princes</p>
        <button class="btn haha">Shop Now</button>
    </div>
</section>





<!--Featured-->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center py-5">
        <h3>Our Featured</h3>
        <hr class="mx-auto">
        <p>Here you can check out our featured products</p>
    </div>
    <div class="row list-product mx-auto container-fluid">

        <?php include ('server/get_featured_products.php');?>

        <?php while($row = $featured_products->fetch_assoc()){?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
            <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>">
                <p class="p-name"><?php echo $row['product_name']; ?></p>
            </a>
            <h4 class="p-price">$<?php echo $row['product_price'];  ?></h4>
            <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button
                    class="fix-btn btn buy-btn">Buy
                    Now</button></a>

        </div>

        <?php } ?>
    </div>


</section>

<!--Banner-->
<section id="banner" class="my-5 py-5">
    <div class="container">
        <h4>MID SEASON'S SALE</h4>
        <h1>Autumn Collection <br> Up to 30% OFF</h1>
        <button class="btn">Shop Now</button>
    </div>
</section>


<!--Clothes-->
<section id="featured" class="my-5">
    <div class="container text-center py-5">
        <h3>Dresses & Coats</h3>
        <hr class="mx-auto">
        <p>Here you can check out our amazing clothes</p>
    </div>
    <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/clothes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/clothes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/clothes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/clothes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>
    </div>
</section>

<!--  New  -->
<section id="new" class="">
    <div class="row p-0 mt-0">
        <!--One-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/1.jpg" />
            <div class="details">
                <form method="POST" action="shop.php">
                    <input type="hidden" value="shoes" name="category">
                    <input type="hidden" value="1000" name="price">
                    <h2>Extremely Awesome Shoes</h2>
                    <button type="submit" name="search" class="text-uppercase">Shop Now</button>
                </form>
            </div>
        </div>



        <!--Two-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/2.jpg" />
            <div class="details">
                <form method="POST" action="shop.php">
                    <input type="hidden" value="coats" name="category">
                    <input type="hidden" value="1000" name="price">
                    <h2>Awesome Jacket</h2>
                    <button type="submit" name="search" class="text-uppercase">Shop Now</button>
                </form>
            </div>
        </div>





        <!--Three-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/3.jpg" />
            <div class="details">
                <form method="POST" action="shop.php">
                    <input type="hidden" value="watches" name="category">
                    <input type="hidden" value="1000" name="price">
                    <h2>50% OFF Watches</h2>
                    <button type="submit" name="search" class="text-uppercase">Shop Now</button>
                </form>
            </div>
        </div>

    </div>
</section>


<!--Watches-->
<section id="featured" class="my-5">
    <div class="container text-center py-5">
        <h3>Best Watches</h3>
        <hr class="mx-auto">
        <p>Here you can check out unique Watches</p>
    </div>
    <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/watches.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/watches.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/watches.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/watches.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>
    </div>
</section>

<!--Shoes-->
<section id="featured" class="my-5">
    <div class="container text-center py-5">
        <h3>Shoes</h3>
        <hr class="mx-auto">
        <p>Here you can check out amazing Shoes</p>
    </div>
    <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/shoes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/shoes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/shoes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/assets/imgs/shoes.jpg" />
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="btn">Buy Now</button>
        </div>
    </div>
</section>

<!-- Brand -->
<section id="brand" class="container">
    <div class="row">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand-1.jpg" />
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand-2.jpg" />
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand-3.jpg" />
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand-4.jpg" />
    </div>
</section>

<?php 
include('layout/footer.php');
?>