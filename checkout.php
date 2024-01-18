<?php
session_start();

if (isset($_SESSION['logged_in'])){

}else{
    header('Location: login.php');
}

if(!empty($_SESSION['cart']) && isset($_POST['checkout']) ){
    //letf user    


    //send user to home page
}else{
    header('Location: index.php');
}



?>

<?php 
include('layout/header.php');
?>

<!--Checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Checkout</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" action="server/place_order.php" method="POST">
            <div class="form-goup checkout-small-element">
                <label for="">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
            </div>

            <div class="form-goup checkout-small-element">
                <label for="">Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
            </div>

            <div class="form-goup checkout-small-element">
                <label for="">Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Password"
                    required />
            </div>

            <div class="form-goup checkout-small-element">
                <label for="">City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
            </div>

            <div class="form-goup checkout-large-element">
                <label for="">Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address"
                    required />
            </div>

            <div class="form-goup checkout-btn-container">
                <p>Total amount: $ <?php echo $_SESSION['total'];?></p>
                <input type="submit" class="btn" id="checkout-btn" value="PLACE ORDER" name="place_order" />
            </div>

        </form>
    </div>
</section>










<?php 
include('layout/footer.php');
?>