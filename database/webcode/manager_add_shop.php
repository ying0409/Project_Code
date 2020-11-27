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
        $_M_ID=$_GET['my_id'];

    ?>
	<script type="text/javascript">
	    function init()
		{
            //time
            var count=1;
            var value="";
            while(count<=7)
            {
                value+="<tr><td>星期"+count+":</td>";
                value+="<td><input type='text' size='5' placeholder='Hour' name='time-op_hr-"+count+"'/></td><td>:</td>";
                value+="<td><input type='text' size='5' placeholder='Minute' name='time-op_min-"+count+"'/></td><td>~</td>";
                value+="<td><input type='text' size='5' placeholder='Hour' name='time-cl_hr-"+count+"'/></td><td>:</td>";
                value+="<td><input type='text' size='5' placeholder='Minute' name='time-cl_min-"+count+"'/></td></tr>";
                document.getElementById("add_time").innerHTML = value;
                count+=1;
            }

		}
        var click_menu=1;
        var m_value="";
        function click_add_menu(){
            m_value+="<tr><td>佳餚名:</td><td><input type='text' name='menu_name_"+click_menu+"'/></td>";
            m_value+="<td>價格:</td><td><input type='text' name='menu_price_"+click_menu+"'/></td></tr>";
            document.getElementById("add_menu").innerHTML = m_value;
            document.getElementById("form").setAttribute("action", "manager_add.php? my_id=<?=$_M_ID?>&menu_num="+click_menu);
            //alert(document.getElementById("form").getAttribute('action'));
            click_menu+=1;
        }
        var d_value="";
        function click_add_discount(){
            
            d_value+="<tr><td>輸入活動內容：</td><td><input type='text' name='add_discount_content' /></td>";
            d_value+="<td>輸入活動截止時間：</td><td><input type='text' name='add_discount_time'/></td></tr>";
            document.getElementById("add_discount").innerHTML = d_value;
        }
	</script>
</head>

<body onload="init()" bgcolor="#FFFAFA">

    <h1 align="center" style="margin-top: 25px">新增店家</h1>
    
    <div style="margin:0px auto;">
        <h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
        

        <form action="manager_add.php? my_id=<?=$_M_ID?>&menu_num=0" method="post" id="form">
            <div style="margin:0px auto;width:80%;">
                <h2 align="center" style="margin-top: 25px">基本資料</h2>
                <table  align="center">
                    <tr>
                        <td>Name</td>
                        <td><input type="text"name="s_name" required="required" placeholder="輸入店家名稱"/></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="text"  name="photo" required="required"  maxlength="50" placeholder="輸入圖片網址"/></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td><input type="text" name="website" required="required"  maxlength="50" placeholder="輸入店家網站網址"/></td>
                    </tr>
                    <tr>
                        <td>(短網址連結</td><td><a href="https://reurl.cc/main/tw">https://reurl.cc/main/tw</a>)</td>
                    </tr>
                    <tr>
                        <td>style</td>
                        <td><input type="radio" name="style" value="日式" required/><label for="contactChoice1">日式</label>
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
                        <td><input type="text" name="phone" required="required" placeholder="輸入店家連絡電話"/></td>
                    </tr>
                    <tr">
                        <td>Address</td>
                        <td><input type="text" name="address" required="required" placeholder="輸入店家地址"/></td>
                    </tr>
                </table>
            </div>

            <hr>
            <h2 align='center' style="margin-top: 25px">菜單</h2>
            <table id="add_menu" align='center'></table>
            <div style="margin-top: 10px" align='center'><input type="button" onclick="click_add_menu()" value="新增佳餚"/></div>
            
            <hr>
            <h2 align='center' style="margin-top: 25px">營業時間</h2>
            <table id="add_time" align='center'></table>
            
            <hr>
            <h2 align='center' style="margin-top: 25px">優惠活動</h2>
            <table id="add_discount" align='center'></table>
            <div style="margin-top: 10px" align='center'><input type="button" onclick="click_add_discount()" value="新增優惠活動" disabled="disabled"/></div>
            <h4 align='center'>(優惠活動請至：主畫面->點選"店家"->點選"編輯" 進行新增~)</h4>

            <hr>
            <h3 align='center'>
                <input type="submit" value="提交" />
                <input type="button" onclick="javascript:location.href='manager_main.php? my_id=<?=$_M_ID?>'" value="取消" />
            </h3>
        </form>
    </div>

</body>

</html>