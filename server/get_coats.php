<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 'coats' limit 4");

$stmt->execute();

$coats_product = $stmt->get_result();



?>