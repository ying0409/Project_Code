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
$s_id = $_POST['s_id'];
$c_id = $_POST['c_id'];

// $s_id = 4;
// $c_id = 2;

if (isset($_POST['star']) && isset($_POST['content']) ) 
{
	$star = $_POST['star'];
	$content = addslashes($_POST['content']);

	$insert_sql = "INSERT INTO comment (c_id,s_id,star,content) VALUES($c_id,$s_id,'$star', '$content')";	// ******** add your comment ********
	
	if ($conn->query($insert_sql) === TRUE )
	{
		echo "<h2 align='center'><font color='antiquewith'>新增成功!!<br> <a href='comment.php? s_id=$s_id & c_id=$c_id'>返回</a></font></h2>";
	}   
	else 
	{
		// echo "新增失敗1<br>";
		// echo "$c_id<br>";
		// echo "$s_id<br>";
		// echo "$star<br>";
		// echo "$content<br>";
		$update_sql = "UPDATE comment SET star='$star', content='$content' where s_id = $s_id and c_id = $c_id";	// ******** update your comment ********
		if ($conn->query($update_sql) === TRUE ) 
		{		
			echo "<h2 align='center'><font color='antiquewith'>已評論過，所以更新評論</font></h2>";
			echo "<h2 align='center'><font color='antiquewith'>更新成功!!<br> <a href='comment.php? s_id=$s_id & c_id=$c_id'>返回</a></font></h2>";
		}  
		else
		{	
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
		}
	}
}
else{
	echo "資料不完全";
}
				
?>