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
		
		$MaNSD = $_GET["id"];
		settype($MaNSD,"int");
		$qr1 = "select * from vanbanden where MaNSD = '$MaNSD'";
		$qr2 = "select * from vanbandi where MaNSD = '$MaNSD'";
		$qr3 = "select * from vanbannoibo where MaNSD = '$MaNSD'";
		$vbd = mysql_query($qr1);
		$vbdi = mysql_query($qr2);
		$vbnb = mysql_query($qr3);
		if(mysql_num_rows($vbd) > 0 || mysql_num_rows($vbdi) > 0 || mysql_num_rows($vbnb) > 0)
		{
			echo "<script>alert('Người dùng này đã có phát sinh văn bản. Anh(Chị) không thể xóa.'); window.location='?active=danhmuc&pages=dsnd';</script>";
		}
		else
		{
			$qr = "
					DELETE from nguoidung WHERE MaNSD = '$MaNSD'
			";
			mysql_query($qr);
			echo "<script>alert('Anh(Chị) đã xóa người dùng thành công.'); window.location='?active=danhmuc&pages=dsnd';</script>";
		}
	}
?>
