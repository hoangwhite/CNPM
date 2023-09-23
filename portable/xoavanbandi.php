<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
	else if($_SESSION["idGr"] !=1)
	{
		header ("location:index.php?active=home&pages=goback");
	}
	else
	{
		
		$MaVB = $_GET["id"];
		settype($MaVB,"int");
		$qr = "
				DELETE from vanbandi WHERE MaVB = '$MaVB'
		";
		mysql_query($qr);
		header ("location:?active=vanbandi&pages=van-ban-di");
	}
?>
