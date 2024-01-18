<?php
include('connection.php');
$stmt = $conn->prepare("SELECT * from products limit 4");

$stmt->execute();

$featured_products = $stmt->get_result();

?>