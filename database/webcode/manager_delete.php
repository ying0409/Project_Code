<?php
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";

$servername = "140.122.184.132";
$username = "team11";
$password ="DBiJWAYu3vUjwN4";
$dbname = "team11";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/**********************/
$_S_ID=$_GET['s_id'];//$_input
$_M_ID=$_GET['m_id'];

if(isset($_POST['delete']))
{
	$delete_discount="DELETE FROM discount WHERE d_id in (
		SELECT D.d_id 
		FROM provide as P natural join (SELECT * FROM discount) as D
		WHERE P.s_id='$_S_ID'
	)";
	if($conn->query($delete_discount) === TRUE)
	{
		//$delete_provide="DELETE FROM provide WHERE s_id='$_S_ID'";
		$delete_comment="DELETE FROM comment WHERE s_id='$_S_ID'";
		$delete_favorate="DELETE FROM favorate WHERE s_id='$_S_ID'";
		$delete_menu="DELETE FROM menu WHERE s_id='$_S_ID'";
		$delete_time="DELETE FROM time WHERE s_id='$_S_ID'";
		if($conn->query($delete_comment)=== TRUE && $conn->query($delete_favorate)=== TRUE && $conn->query($delete_menu)=== TRUE && $conn->query($delete_time)=== TRUE)
		{
			$delete_shop="DELETE FROM shop WHERE s_id='$_S_ID'";
			if($conn->query($delete_shop)=== TRUE){
				echo "<div align='center'><h3>已刪除!</h3> <br>
				<a href='manager_main.php? my_id=$_M_ID'>返回</a></div>";
			}
			else{
				echo "error:delete shop";
			}
		}
		else{
			echo "error:delete expect shop";
		}
	}
	else{
		echo "error:delete discount";
		echo "<h2 align='center'><font color='antiquewith'>刪除失敗!!</font></h2><br>
		<a href='manager_shop.php? num=$_S_ID&my_id=$_M_ID'><返回></a></div>";
	}
}
else{
	echo "資料不完整?";
}

			
?>

