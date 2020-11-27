<html>

<head>
	<title>美食地圖</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		input[type="submit"] {
			padding: 5px 15px;
			background: #ccc;
			border: 0 none;
			cursor: pointer;
			-webkit-border-radius: 5px;
			border-radius: 5px;
		}

		input[type="button"] {
			padding: 5px 15px;
			background: #ccc;
			border: 0 none;
			cursor: pointer;
			-webkit-border-radius: 5px;
			border-radius: 5px;
		}
	</style>
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
        /**************************/
        $_S_ID=$_GET['s_id'];
        $_M_ID=$_GET['my_id'];
        $shop_query ="SELECT * FROM shop WHERE s_id='$_S_ID'";
        $shop_result = $conn->query($shop_query);
        if ($shop_result->num_rows > 0) 
        {
            $row = mysqli_fetch_array ( $shop_result, MYSQLI_ASSOC );
            $name_value=$row[s_name];
            $photo_value=$row[photo];
            $website_value=$row[website];
            $style_value=$row[style];
            $phone_value=$row[phone];
            $address_value=$row[address];
        }

        //ex:name='menu_name_$count."'
        $menu_query ="SELECT * FROM menu WHERE s_id='$_S_ID'";
        $menu_result = $conn->query($menu_query);
        if ($menu_result->num_rows > 0) 
        {
            $menu_value='<tr><td>Name</td><td>Price</td><tr>';
            //$count=1;
            while($row = mysqli_fetch_array ( $menu_result, MYSQLI_ASSOC ) ) {
                //$menu_value=$menu_value.'/ '.$row[d_name].':'.$row[price];
                $menu_value=$menu_value."<tr><td>".$row[d_name]."</td><td>";//<input type='text' value='".$row[d_name]."' name='menu_name_".$count."'/></td>";
                $menu_value=$menu_value."<td>".$row[price]."</td></tr>";//<td><input type='text' value='".$row[price]."' name='menu_price_".$count."'/></td></tr>";
                //$count=$count+1;
            }/**/
        }

        //ex:name='time-op_hr-1'
        $time_query ="SELECT * FROM time WHERE s_id='$_S_ID'";
        $time_result = $conn->query($time_query);
        if ($time_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $time_result, MYSQLI_ASSOC ) ) {
                $time_value=$time_value."<tr><td>星期".$row[day].":open</td>";
                $time_value=$time_value."<td><input type='text' size='5' value='".$row[op_hr]."' name='time-op_hr-".$row[day]."'/></td><td>:</td>";
                $time_value=$time_value."<td><input type='text' size='5' value='".$row[op_min]."' name='time-op_min-".$row[day]."'/></td><td>~</td>";
                $time_value=$time_value."<td><input type='text' size='5' value='".$row[cl_hr]."' name='time-cl_hr-".$row[day]."'/></td><td>:</td>";
                $time_value=$time_value."<td><input type='text' size='5' value='".$row[cl_min]."' name='time-cl_min-".$row[day]."'/></td></tr>";
            }
        }

        //discount_1
        $discount_query ="SELECT D.d_id as d_id,D.content as content,P.t_id as t_id
        FROM provide as P natural join discount as D
        WHERE P.s_id='$_S_ID'";
        $discount_result = $conn->query($discount_query);
        if ($discount_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $discount_result, MYSQLI_ASSOC ) ) {
                //$discount_value=$discount_value.'/ '.$row[content];
                $discount_value=$discount_value."<tr><td>[ID:".$row[d_id]."]</td><td>活動內容:".$row[content]."</td><td>截止時間:".$row[t_id]."</td></tr>";
            }
        }
             

    ?>
	<script type="text/javascript">
	    function init()
		{
            //name
            var name_value="<?php echo $name_value; ?>";
            document.getElementById("s_name").value=name_value;

            //photo
            var photo_value="<?php echo $photo_value; ?>";
            document.getElementById("photo").value=photo_value;

            //var name='website';
            var website_value="<?php echo $website_value; ?>";//alert(website_value);
            document.getElementById("website").value=website_value;

            //style
            var style_value="<?php echo $style_value; ?>";
            var form_style=document.getElementById("form_main").style;
            var index=-1;
            switch(style_value)
            {
                case "日式":
                    index=0;
                    break;
                case "美式":
                    index=1;
                    break;
                case "中式":
                    index=2;
                    break;
                case "義式":
                    index=3;
                    break;
                case "韓式":
                    index=4;
                    break;
                case "飲料":
                    index=5;
                    break;
                case "火鍋":
                    index=6;
                    break;
                case "甜點":
                    index=7;
                    break;
                case "素食":
                    index=8;
                    break;
                case "早餐":
                    index=9;
                    break;
                case "其他":
                    index=10;
                    break;
                default:
                    index=-1;
                    break;
            }
            if(index!=-1){
                form_style[index].checked=true;
            }
            
            //phone
            var phone_value="<?php echo $phone_value; ?>";
            document.getElementById("phone").value=phone_value;

            //address
            var address_value="<?php echo $address_value; ?>";
            document.getElementById("address").value=address_value;

            //menu
            var menu_value="<?php echo $menu_value; ?>";
            //alert(menu_value);
            document.getElementById("menu").innerHTML = menu_value;


            //time
            var time_value="<?php echo $time_value; ?>";
            //alert(time_value);
            document.getElementById("time").innerHTML = time_value;

            //discount
            var discount_value="<?php echo $discount_value; ?>";
            document.getElementById("discount").innerHTML =discount_value;
		}
	</script>
</head>

<body onload="init()" bgcolor="#FFFAFA">

    <h1 align="center" style="margin-top: 25px">編輯</h1>
    
    <div style="margin:0px auto;">
        <h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
        

        <form action="manager_update.php? s_id=<?=$_S_ID?>&m_id=<?=$_M_ID?>" method="post" id="form_main">
            <div style="margin:0px auto;width:80%;">
                <h2 align="center" style="margin-top: 25px">基本資料</h2>
                <table  align="center">
                    <tr>
                        <td>Name</td>
                        <td><input type="text" id="s_name" name="s_name" required="required" /></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="text" id="photo" name="photo" required="required"  maxlength="50"/></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td><input type="text" id="website" name="website" required="required"  maxlength="50"/></td>
                    </tr>
                    <tr>
                        <td>(短網址連結</td><td><a href="https://reurl.cc/main/tw">https://reurl.cc/main/tw</a>)</td>
                    </tr>
                    <tr>
                        <td>style</td>
                        <td><input type="radio" name="style" value="日式" required/><label for="contactChoice1" >日式</label>
                        <input type="radio" name="style" value="美式"/><label for="contactChoice1">美式</label>
                        <input type="radio" name="style" value="中式"/><label for="contactChoice1">中式</label>
                        <input type="radio" name="style" value="義式"/><label for="contactChoice1">義式</label>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="style" value="韓式"/><label for="contactChoice1">韓式</label>
                        <input type="radio" name="style" value="飲料"/><label for="contactChoice1">飲料</label>
                        <input type="radio" name="style" value="火鍋"/><label for="contactChoice1">火鍋</label>
                        <input type="radio" name="style" value="甜點"/><label for="contactChoice1">甜點</label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="style" value="素食"/><label for="contactChoice1">素食</label>
                        <input type="radio" name="style" value="早餐"/><label for="contactChoice1">早餐</label>
                        <input type="radio" name="style" value="其他"/><label for="contactChoice1">其他</label></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" id="phone" name="phone" required="required" /></td>
                    </tr>
                    <tr">
                        <td>Address</td>
                        <td><input type="text" id="address" name="address" required="required" /></td>
                    </tr>
                </table>
            </div>

            <hr>
            <h2 align='center' style="margin-top: 25px">菜單</h2>
            <table id="menu" align='center'></table>
            <table align='center' style="margin-top: 15px">
                <tr>
                    <td>新增一道佳餚=></td>
                    </td>
                    <td>Name:<input type="text" name="add_food_name" /></td><td> Price:<input type="text" name="add_food_price" /></td> 
                </tr>
                <tr>
                    <td>刪除一道佳餚=></td>
                    <td>Name:<input type="text" name="delete_food_name" /></td><td> </td>
                </tr>
            </table>

            <hr>
            <h2 align='center' style="margin-top: 25px">營業時間</h2>
            <table id="time" align='center'></table>
            

            <hr>
            <h2 align='center' style="margin-top: 25px">優惠活動</h2>
            <table id="discount" align='center'></table>
            <table align='center' style="margin-top: 15px">
                <tr>
                    <td>新增優惠活動=></td>
                    <td>輸入活動內容：</td>
                    <td><input type="text" name="add_discount" /></td>
                    <td>輸入活動期限：</td>
                    <td><input type="text" name="add_provide" /></td>
                </tr>
                <tr>
                    <td>刪除優惠活動=></td>
                    <td>輸入活動ID:</td>
                    <td><input type="text" name="delete_d_id" /></td>
                </tr>
            </table>

            <h3 align='center'>
                <input type="submit" value="更新" />
                <input type="button" onclick="javascript:location.href='manager_shop.php?num=<?=$_S_ID?>&my_id=<?=$_M_ID?>'" value="取消" />
            </h3>
        </form>
    </div>

</body>

</html>