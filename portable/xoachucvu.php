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
		$MaCV = $_GET["id"];
		settype($MaCV,"int");
		$qr = "
				DELETE from chucvu WHERE MaCV = '$MaCV'
		";
		mysql_query($qr);
		header ("location:?active=danhmuc&pages=dscv");
	}
?>