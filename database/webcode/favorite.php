<?php
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";

$servername = "140.122.184.132";
$username = "team11";
$password ="DBiJWAYu3vUjwN4";
$dbname = "team11";

// Connecting to and selecting a MySQL database
$link = new mysqli($servername, $username, $password, $dbname);


if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 

$my_id = $_GET["my_id"];
$_input = $_GET["num"];

$query = "SELECT * FROM favorate where c_id=$my_id and s_id=$_input";
$result = $link->query($query);
if($result->num_rows > 0){
	$delete_sql = "DELETE FROM favorate WHERE c_id=$my_id and s_id=$_input";
	if ($link->query($delete_sql) === TRUE) {
		echo "<meta http-equiv='refresh' content='0;url= customer_shop.php?my_id=$my_id&num=$_input' />";
	}
}
else{
	$insert_sql = "INSERT INTO favorate (c_id,s_id) VALUES ('$my_id','$_input')";
	if ($link->query($insert_sql) === TRUE) {
		echo "<meta http-equiv='refresh' content='0;url= customer_shop.php?my_id=$my_id&num=$_input' />";
	}
}
?>