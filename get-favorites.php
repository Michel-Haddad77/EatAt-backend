<?php
include("connection.php");

if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}else{
    die("missing user id");
}

$query = $mysqli->prepare("select *, description from restaurants join favorites on favorites.restaurant_id = restaurants.id where favorites.user_id = ?");
$query->bind_param("s", $user_id);
$query->execute();

$array = $query->get_result();
$num_rows = $array->num_rows;

$response = [];

if ($num_rows == 0) {
    $response["response"] = "No Favorite Restaurant Yet";
}else{
    while($favorites = $array->fetch_assoc()){
        $response[] = $favorites;
    }
    // $response["data"] = $result;
    // $response["success"] = true;
}

$json = json_encode($response);
echo $json;
?>