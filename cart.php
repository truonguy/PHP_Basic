<?php
session_start();
//caculateTotal
calculateTotalCart();
if (isset($_POST['add_to_cart'])) {
    // Kiểm tra nếu giỏ hàng đã được khởi tạo trong phiên làm việc
    if (isset($_SESSION['cart'])) {
      
        $product_id = $_POST['product_id'];
        
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        if (isset($_SESSION['cart'][$product_id])) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng lên
            $_SESSION['cart'][$product_id]['product_quantity'] += $_POST['product_quantity'];
        } else {
            $product_id = $_POST['product_id'];
            // Nếu sản phẩm chưa tồn tại, tạo một mảng chứa thông tin sản phẩm
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            // Thêm sản phẩm vào giỏ hàng bằng cách gán vào mảng $_SESSION['cart']
            $_SESSION['cart'][$product_id] = $product_array;
        }
    } else {
        // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng và thêm sản phẩm đầu tiên vào giỏ hàng
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $_POST['product_image'],
            'product_quantity' => $product_quantity
        );

        // Tạo giỏ hàng và thêm sản phẩm đầu tiên vào giỏ hàng
        $_SESSION['cart'][$product_id] = $product_array;
    }
    


    //remove product from cart
}else if(isset($_POST['remove_product'])){
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    //caculateTotal
    calculateTotalCart();



 }else if(isset($_POST['edit_quantity'])){
    //we got id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get  the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    //caculateTotal
    calculateTotalCart();
 }else {
    

}


function calculateTotalCart()
{
    $total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $price = $value['product_price'];
            $quantity = $value['product_quantity'];
            $total += ($price * $quantity);
        }
    }
    $_SESSION['total'] = $total;
}

?>


<?php 
include('layout/header.php');
?>

<!--Cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
              foreach($_SESSION['cart'] as $key => $value ) {  ?>

        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo $value['product_image'] ?>" alt="" />
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>$</span><?php echo $value['product_price'] ?></small>
                        <br>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" id="" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" name="remove_product" href="#" class="remove-btn" value="remove" />
                        </form>

                    </div>
                </div>
            </td>

            <td>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'] ?>" />
                    <input type="submit" class="edit-btn" value="edit" name="edit_quantity">

                </form>

            </td>

            <td>
                <span>$</span>
                <span class="product-price"><?php  echo $value['product_quantity'] *  $value['product_price'] ?></span>
            </td>
        </tr>

        <?php } 
} else {
    echo "<tr><td colspan='3'>Your cart is empty.</td></tr>";
}
?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>$<?php echo $_SESSION['total'] ?></td>
            </tr>
        </table>
    </div>


    <div class="checkout-container">
        <form action="checkout.php" method="POST">
            <input type="submit" class="btn checkout-btn" value="checkout" name="checkout">
        </form>
    </div>

</section>




<?php 
include('layout/footer.php');
?>