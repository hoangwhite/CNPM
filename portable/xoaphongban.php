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
		
		$MaPB = $_GET["id"];
		settype($MaPB,"int");
		$qr = "
				DELETE from phongban WHERE MaPB = '$MaPB'
		";
		mysql_query($qr);
		header ("location:?active=danhmuc&pages=dspb");
	}
?>