<html>

<head>
	<title>美食地圖</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body onload="init()" bgcolor="#FFFAFA">

	<h1 align="center" style="margin-top: 25px">刪除店家</h1>
    <h2 align='center'><img src="https://i.imgur.com/xZg3RoM.gif" /></h2>
    <h3 align='center'>確定要刪除店家嗎?</h3>

    <?php
        $_S_ID=$_GET['s_id'];
        $_M_ID=$_GET['my_id'];
    ?>
    <form action="manager_delete.php? s_id=<?=$_S_ID?>&m_id=<?=$_M_ID?>" method="post" align='center'>
        <input type="submit" name="delete" value="刪除"/>
		<input type ="button" onclick="javascript:location.href='manager_shop.php? num=<?=$_S_ID?>&my_id=<?=$_M_ID?>'" value="取消">
    </form>


</body>

</html>