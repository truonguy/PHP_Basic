<?php
session_start();
include('connection.php');

if (!isset($_SESSION['logged_in'])){
    header('Location: ../checkout.php?message=Please Login/register to place an order');
    exit;
}else{


if (isset($_POST['place_order'])) {
    // 1. Get user info and store it in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 0;
    $user_id = $_SESSION['user_id']; 
    $order_date = date('Y-m-d H:i:s');

    //Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    //Bind the parameters to the prepared statement
    $stmt->bind_param('sisssss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    //Execute the SQL statement
    if ($stmt->execute()) {
        //Get the last inserted order ID
        //2. issue new order and store order info in database
        $order_id = $stmt->insert_id;
        //3. inform user whether everything is fine or there is a problem
        header('location: ../payment.php?order_status=order placed successfully');

    } else {
        echo "Error placing the order.";
    }

    //Close the statement
    $stmt->close();


//4. get products from cart (from session)
$_SESSION['cart']; 
foreach($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];

    //5. store each single item in order order_items database
    $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                    VALUES (?,?,?,?,?,?,?,?) ");
    $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
    $stmt1->execute();


}


//6. remove everything from cart -> delay until payment is done
//unset($SESSION['cart']);




} else {
    echo "Form submission not detected.";
}

}
?>