<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
	<h1 align="center" style="margin-top: 25px">詳細資訊</h1>
	<h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
<ul>
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

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_main.php?my_id=$my_id'>回到主畫面</a></font></h3>";
if ($result->num_rows > 0) {
	echo "<table align='center'  border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<tr><td><img src = '$row[photo]' width='500' height='300'></img>";
		echo "<td align='center'><h2><b>★☆$row[s_name]☆★</b></h2>";
		echo '<h2>相關資訊</h2>';
		echo '<a href = " ' . $row[website] . ' ">Website</a>';
		echo "<table>";
		echo '<tr><td>風格：</td>';
		echo "<td>$row[style]</td></tr>";
		echo '<tr><td>電話：</td>';
		echo "<td>$row[phone]</td></tr>";
		echo '<tr><td>地址：</td>';
		echo "<td>$row[address]</td></tr>";
		echo '<tr><td>評價：</td>';
		echo "<td>";
		switch ($row[avestar]) {
			case 0:
				echo "☆☆☆☆☆";
				break;
			case 1:
				echo "★☆☆☆☆";
				break;
			case 2:
				echo "★★☆☆☆";
				break;
			case 3:
				echo "★★★☆☆";
				break;
			case 4:
				echo "★★★★☆";
				break;
			case 5:
				echo "★★★★★";
				break;
		}
		echo "</td></table>";
		echo '<br>';
		echo "<button><a href='menu.php? s_id=$_input&c_id=$my_id' style='text-decoration:none;'>菜單</a></button>";
		echo "<button><a href='time.php? s_id=$_input&c_id=$my_id' style='text-decoration:none;'>營業時間</a></button>";
		echo "<button><a href='discount.php? s_id=$_input&c_id=$my_id' style='text-decoration:none;'>優惠</a></button>";
		echo "<button><a href='comment.php?  s_id=$_input&c_id=$my_id'style='text-decoration:none;'>評論</a></button>";
		echo "<br>";
		$favorite_sql = "SELECT * FROM favorate where c_id = $my_id and s_id = $_input";
		$temp = $link->query($favorite_sql);
		if ($temp->num_rows > 0) echo "<button><a href='favorite.php? my_id=$my_id&num=$_input' style='text-decoration:none;'>取消收藏此店家</a></button></td>";
		else echo "<button><a href='favorite.php? my_id=$my_id&num=$_input' style='text-decoration:none;'>收藏此店家</a></button></td>";
		echo "</td></tr>";
	}
	echo "</table>";
}
?>	

	</ul>



</body>