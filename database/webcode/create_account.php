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

$count=0;

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

if (isset($_POST['identity']) &&  isset($_POST['name']) && isset($_POST['account']) && isset($_POST['password']) && isset($_POST['email'])) {
	$identity = $_POST['identity'];
	$name = $_POST['name'];
	$account = $_POST['account'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if($identity==1){
		$count_sql ="SELECT count(m_id)as count FROM manager";
	}
	if($identity==0){
		$count_sql ="SELECT count(c_id)as count FROM customer";
	}
	$result = $conn->query($count_sql);
	$row = $result->fetch_assoc();
	$count=$row[count]+1;
	//echo "$count";
	if($identity==1)$check_sql ="SELECT * FROM manager WHERE account='$account'";
	if($identity==0)$check_sql ="SELECT * FROM customer WHERE account='$account'";
	$result = $conn->query($check_sql);	// Send SQL Query
	if ($result->num_rows > 0) {
		echo "<h3 align='center'><font color='antiquewith'>新增失敗!!!<br>這個帳號已有人使用<br>";
		echo "<a href = 'register_new.html'>回到註冊畫面</a></font></h3>";
	}
	else{
		if($identity==1)$insert_sql = "INSERT INTO manager (m_id,m_name,account,password,email)VALUES('$count','$name','$account','$password','$email')";	// ******** update your personal settings ******** 
		if($identity==0)$insert_sql = "INSERT INTO customer (c_id,c_name,account,password,email)VALUES('$count','$name','$account','$password','$email')";	// ******** update your personal settings ******** 

		if ($conn->query($insert_sql) === TRUE) {
			echo "<h3 align='center'><font color='antiquewith'>新增成功<br>";
			echo "<a href = 'signin_new.html'>前往登入畫面</a></font></h3>";
	}
	// else {
		// echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	// }
	}

}else{
	echo "資料不完全";
}

?>
</body>
</html>
