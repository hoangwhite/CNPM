<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:?active=home&pages=dang-nhap");
	}
	else if($_SESSION["idGr"] !=1)
	{
		header ("location:?active=home&pages=goback");
	}
	else
	{
		
		$MaLVB = $_GET["id"];
		settype($MaLVB,"int");
		$qr1 = "
			SELECT * from vanbanden Where MaLVB = '$MaLVB'
		";
		$qr2 = "
			SELECT * from vanbandi Where MaLVB = '$MaLVB'
		";
		$qr3 = "
			SELECT * from vanbannoibo Where MaLVB = '$MaLVB'
		";
		$vbd = mysql_query($qr1);
		$vbdi = mysql_query($qr2);
		$vbnb = mysql_query($qr3);
		if(mysql_num_rows($vbd)>0 || mysql_num_rows($vbdi)>0 || mysql_num_rows($vbnb)>0){
			echo "<script>alert('Loại văn bản này đã được sử dụng nên không thể xóa.');window.location='?active=danhmuc&pages=dslcv';</script>";
		}
		else
		{
			$qr = "
					DELETE from loaivanban WHERE MaLVB = '$MaLVB'
			";
			mysql_query($qr);
			header ("location:?active=danhmuc&pages=dslcv");
		}
	}
?>