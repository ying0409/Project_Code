<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
<h1 align="center" style="margin-top: 25px">營業時間</h1>
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

$s_id = $_GET['s_id'];
$c_id = $_GET['c_id'];
$identity=$_GET["identity"];

$is_exist=0;

if($identity==1)echo "<h3 align='center'><font color='antiquewith'><a href = 'manager_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";
else echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";

$query = "SELECT * FROM shop NATURAL JOIN time where s_id=$s_id";
$result = $link->query($query);

if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		$is_exist=1;
		echo "<h3 align='center'>";
		switch ($row[day]) 
		{
			
			case 1:
				echo "星期一";
				break;
			case 2:
				echo "星期二";
				break;
			case 3:
				echo "星期三";
				break;
			case 4:
				echo "星期四";
				break;
			case 5:
				echo "星期五";
				break;
			case 6:
				echo "星期六";
				break;
			case 7:
				echo "星期日";
				break;
		}
		echo " ";
		if($row[op_hr]<10)
			echo "0";
		echo "$row[op_hr]";
		
		echo ":";
		if($row[op_min]<10)
			echo "0";
		echo "$row[op_min]";
		
		echo "~";
		if($row[cl_hr]<10)
			echo "0";
		echo "$row[cl_hr]";
		
		echo ":";
		if($row[cl_min]<10)
			echo "0";
		echo "$row[cl_min]<br>";
		
		echo "</h3>";
	}
}
if($is_exist===0)
{
	echo "<h2 align='center'><font color='antiquewith'>目前尚無資料<br> </font></h2>";
}
?>
	
</body>
</html>