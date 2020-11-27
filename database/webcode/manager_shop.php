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
echo "<h3 align='center'><font color='antiquewith'><a href = 'manager_main.php?my_id=$my_id'>回到主畫面</a></font></h3>";//error!!!
if ($result->num_rows > 0) {
	echo "<table align='center' border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<tr><td><img src = '$row[photo]' width='500' height='300'></img></td>";
		echo "<td align='center'><h1><b>★☆$row[s_name]☆★</b></h1>";
		echo '<h2>相關資訊</h2>';
		echo '<table >';
		echo '<a href = " ' . $row[website] . ' ">Website</a>';
		echo '<tr>';
		echo '<td>風格：</td>';
		echo "<td>$row[style]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>電話：</td>';
		echo "<td>$row[phone]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>地址：</td>';
		echo "<td>$row[address]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>評價：</td>';
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
		echo '</td></tr>';
		echo '</table><br>';
		echo "<button><a href='menu.php? s_id=$_input&c_id=$my_id&identity=1' style='text-decoration:none;'>菜單</a></button>";
		echo "<button><a href='time.php? s_id=$_input&c_id=$my_id&identity=1' style='text-decoration:none;'>營業時間</a></button>";
		echo "<button><a href='discount.php? s_id=$_input&c_id=$my_id&identity=1' style='text-decoration:none;'>優惠</a></button>";
		echo "<button><a href='manager_comment.php?  s_id=$_input&c_id=$my_id'style='text-decoration:none;'>評論</a></button>";
		echo "<br>";
		echo "<button><a href='manager_exit_shop.php? s_id=$_input&my_id=$my_id'  style='text-decoration:none;'>編輯</a></button>";
		echo "<button><a href='manager_delete_shop.php? s_id=$_input&my_id=$my_id'  style='text-decoration:none;'>刪除</a></button>";
	}
	echo "</table>";
}
?>	

	</ul>



</body>