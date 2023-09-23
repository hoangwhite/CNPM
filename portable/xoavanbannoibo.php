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
		require "lib/trangchu.php";
		$MaVB = $_GET["id"];
		settype($MaVB,"int");
		$qr = "
				DELETE from vanbannoibo WHERE MaVB = '$MaVB'
		";
		mysql_query($qr);
		header ("location:index.php?active=vanbannoibo&pages=van-ban-noi-bo");
	}
?>
<?php
/*
	*/
?>
