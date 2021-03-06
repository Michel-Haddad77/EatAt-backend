<?php
include("connection.php");

if(isset($_GET["restaurant_id"])){
    $restaurant_id = $_GET["restaurant_id"];
}else{
    die("missing restaurant id");
}


$query = $mysqli->prepare("select avg(ratings), count(ratings) from reviews where restaurant_id = ?");
$query->bind_param("s", $restaurant_id);
$query->execute();

$array = $query->get_result();
$num_rows = $array->num_rows;

$response = [];
$restaurant = $array->fetch_assoc();
$response = $restaurant;

$json = json_encode($response);
echo $json;
?>