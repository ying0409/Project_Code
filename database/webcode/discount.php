<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
	<h1 align="center" style="margin-top: 25px">現正優惠</h1>
<h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>


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

$s_id = $_GET["s_id"];
$c_id = $_GET['c_id'];
$identity=$_GET["identity"];

if($identity==1)echo "<h3 align='center'><font color='antiquewith'><a href = 'manager_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";
else echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";

$query = "SELECT content from shop NATURAL JOIN provide NATURAL JOIN discount WHERE s_id = $s_id";
$result = $link->query($query);
$is_exist=0;
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) 
	{
		$is_exist=1;
		echo "<h3 align='center'>";
		echo "$row[content] <br>";
	}
}

if($is_exist===0)
{
	echo "<h2 align='center'><font color='antiquewith'>目前尚無優惠<br> </font></h2>";
}	

//echo "<h3 align='center'><button><a href='customer_shop.php? num=$s_id&my_id=$c_id' style='text-decoration:none;'>返回</a></button></h3>";

?>

</body>
	
</html>