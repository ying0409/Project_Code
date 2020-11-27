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
/***************************/

$_S_ID = $_GET['s_id'];//$_input
$_M_ID = $_GET['m_id'];
$_CORRECT=TRUE;
$_COUNT=0;

if (isset($_POST['s_name']) && isset($_POST['photo']) && isset($_POST['website']) &&  isset($_POST['style']) && isset($_POST['phone']) && isset($_POST['address'])) {
    $s_name=$_POST['s_name'];
    $photo = $_POST['photo'];
    $website = $_POST['website'];
    $style = $_POST['style'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $update_shop="UPDATE shop SET s_name='$s_name',photo='$photo',website='$website',style='$style',phone='$phone',address='$address' WHERE s_id = '$_S_ID'";
    if ($conn->query($update_shop) === FALSE) {
        echo "error:update shop";
        $_CORRECT=FALSE;
    } 

    //time
    $query = "SELECT * FROM time where s_id = '$_S_ID'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
            $op_hr=$_POST["time-op_hr-$row[day]"];
            $op_min=$_POST["time-op_min-$row[day]"];
            $cl_hr=$_POST["time-cl_hr-$row[day]"];
            $cl_min=$_POST["time-cl_min-$row[day]"];
            $update_time="UPDATE time SET op_hr='$op_hr',op_min='$op_min',cl_hr='$cl_hr',cl_min='$cl_min'  WHERE day = '$row[day]' and s_id='$_S_ID' ";
            if ($conn->query($update_time) === FALSE){
                echo 'error:time update';
                $_CORRECT=FALSE;
            }
        }
    }
    
    //menu
    if (isset($_POST['add_food_name']) &&  isset($_POST['add_food_price']))
    {
        $add_name=$_POST['add_food_name'];
        $add_price=$_POST['add_food_price'];
        $insert_menu="INSERT into menu(`s_id`,`d_name`,`price`) values('$_S_ID','$add_name','$add_price') ";
        if ($conn->query($insert_menu) === FALSE){
            echo 'no insert menu';
            $_CORRECT=FALSE;
        }
    }else{
        echo "data lost:add menu";
        $_CORRECT=FALSE;
    }
    
    if(isset($_POST['delete_food_name']))
    {
        $delete_name=$_POST['delete_food_name'];
        $delete_menu="DELETE FROM menu where d_name='$delete_name' and s_id='$_S_ID'"; 
        if ($conn->query($delete_menu) === FALSE){
            echo 'no delete menu';
            $_CORRECT=FALSE;
        }
    }else{
        echo "data lost:delete menu";
        $_CORRECT=FALSE;
    }
    
    //discount
    if (isset($_POST['add_discount'])&&isset($_POST['add_provide']))
    {
        if($_POST['add_discount'] != '')
        {
             $add_content=$_POST['add_discount'];
            $add_time=$_POST['add_provide'];
            //get s_id
            $get_did_sql="SELECT MAX(d_id) as max_id FROM `discount`";
            $get_did_result=$conn->query($get_did_sql);
            $row=$get_did_result->fetch_assoc();
            $add_d_id=$row[max_id]+1;
            //echo "<h3>test:$add_d_id</h3>";
            $insert_discount="INSERT into discount(`d_id`,`content`) values('$add_d_id','$add_content') ";
            if ($conn->query($insert_discount) === TRUE){
                $insert_provide="INSERT into provide(`s_id`,`d_id`,`t_id`) values('$_S_ID','$add_d_id','$add_time') ";
                if($conn->query($insert_provide) === FALSE){
                    echo'no insert provide';
                    $_CORRECT=FALSE;
                }
            }else{
                echo "no insert discount ";
                echo "<h3>$add_d_id</h3>";
                $_CORRECT=FALSE;
            }
        }

    }else{
        echo "data lost:add discount";
        $_CORRECT=FALSE;
    }

    if(isset($_POST['delete_d_id']))
    {
        $delete_d_id=$_POST['delete_d_id'];
        $delete_discount="DELETE FROM discount where d_id='$delete_d_id' "; 
        if ($conn->query($delete_discount) === FALSE){
            echo 'no delete discount';
            $_CORRECT=FALSE;
        }
    }else{
        echo "data lost:delete discount";
        $_CORRECT=FALSE;
    }
    
    if($_CORRECT === TRUE)
    {
        echo "<div align='center'><h3>已更新!</h3>
		<a href='manager_shop.php? num=$_S_ID&my_id=$_M_ID'>返回</a></div>";
    }
    else{
        echo "<h2 align='center'><font color='antiquewith'>更新失敗!!</font></h2><br>
        <div align='center'>
        <a href='manager_exit_shop.php? s_id=$_S_ID&m_id=$_M_ID'><再試一次></a>
        <a href='manager_shop.php? num=$_S_ID&my_id=$_M_ID'><返回></a>
        </div>";
    }
    
}
else{
	echo "資料不完全";
}
			
?>

