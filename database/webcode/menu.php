<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
<h1 align="center" style="margin-top: 25px">菜單</h1>
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
$c_id = $_GET["c_id"];
$identity=$_GET["identity"];

if($identity==1)echo "<h3 align='center'><font color='antiquewith'><a href = 'manager_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";
else echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";

$query = "SELECT * FROM shop NATURAL JOIN menu where s_id= $s_id";
$result = $link->query($query);
echo "<table align='center' width='300' border='1'>";
echo "<tr><td>項目</td>";
echo "<td>價格</td></tr>";
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo "<td>$row[d_name]</td>";
		echo "<td>$row[price]<br></td>";
	echo '</tr>';
	}
}
echo '</table >';
?>