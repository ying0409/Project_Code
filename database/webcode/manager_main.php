<html>
<head>
    <title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="UTF-8">
    <title>Untitled Document</title>
    
<style>
	input[type="button"]{padding:5px 15px; background:#ccc;
	border:0 none;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
	.demo{
	padding-top: 20px;
	text-align: center
	}
</style>
</head>
<body bgcolor="#FFFAFA">
<?php
    $my_id=$_GET["my_id"];
?>
<h1 align="center" style="margin-top: 25px">首頁</h1>
    <h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
	<h2 align="center"><input type ="button" onclick="javascript:location.href='manager_add_shop.php?my_id=<?=$my_id?>'" value="新增店家"></input></h2>
<ul>
<?php

//******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";

$servername = "140.122.184.132";
$username = "team11";
$password ="DBiJWAYu3vUjwN4";
$dbname = "team11";

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM shop WHERE m_id=$my_id";
$result = $conn->query($query);
$count=0;
if ($result->num_rows > 0) {
    echo "<h2 align='center'><font color='antiquewith'>您所管理的店家列表</font></h2>";
	echo "<table align='center' border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		if($count%2==0)echo "<tr>";
		echo "<td><a href='manager_shop.php? num=$row[s_id]&my_id=$my_id'<b>$row[s_name]</b></a></td>";
		echo "<td><img src='$row[photo]' width='500' height='300'/></img></td>";
		$count+=1;
		if($count%2==0){
			$count=0;
			echo "</tr>";
		}
	}	
	echo "</table>";
}		
else{
	echo "<h2 align='center'><font color='antiquewith'>您還未管理任何店家喔</font></h2>";
}
?> 
</ul>
</body>
</html>
