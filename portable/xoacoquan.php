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
		
		$MaCQ = $_GET["id"];
		settype($MaCQ,"int");
		$qr = "
				DELETE from coquan WHERE MaCQ = '$MaCQ'
		";
		mysql_query($qr);
		header ("location:?active=danhmuc&pages=dscq");
	}
?>