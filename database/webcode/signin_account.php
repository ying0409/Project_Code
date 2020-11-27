<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="UTF-8">
    <title>Untitled Document</title>

</head>
<body bgcolor="#FFFAFA">
<h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
<?php

// ******** update your personal settings ******** 
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
if (isset($_POST['identity']) && isset($_POST['account']) && isset($_POST['password'])) {
	$identity = $_POST['identity'];
	$account = $_POST['account'];
	$password = $_POST['password'];
	
	if($identity==1)$check_sql = "SELECT m_id FROM manager WHERE account='$account' AND password='$password'";	// ******** update your personal settings ******** 
	if($identity==0)$check_sql = "SELECT c_id FROM customer WHERE account='$account' AND password='$password'";	// ******** update your personal settings ******** 
	
	$result = $conn->query($check_sql);	// Send SQL Query
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
		if($identity==1)echo "<h2 align='center'><font color='#41B3B4'>登入成功<br> <a href='manager_main.php ? my_id=$row[m_id]'><font color='#2A7071 '>開始你/妳的美食地圖</a></font></h2>";
		if($identity==0)echo "<h2 align='center'><font color='#41B3B4'>登入成功<br> <a href='customer_main.php ? my_id=$row[c_id]'><font color='#2A7071 '>開始你/妳的美食地圖</a></font></h2>";
	}
	else {
		echo "<h2 align='center'><font color='#41B3B4'>登入失敗<br> <a href='signin_new.html'>返回登入畫面</a></font></h2>";
	}
}
else{
	echo "資料不完全";
}
				
?>
</body>
</html>
