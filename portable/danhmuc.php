<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&&pages=dang-nhap");
	}
?>
<link rel="stylesheet" type="text/css" href="css/table.css"/>
<div class="page_div_danhmuc">
	<center><div class="mndanhmuc">LOẠI VĂN BẢN</div></center>
    <?php
		$qr ="
				SELECT * FROM loaivanban limit 0, 4
		";
		$_lcv = mysql_query($qr);
		if(mysql_num_rows($_lcv) > 0){
	?>
    <table style="margin-top:5px; margin-bottom:5px" border="1">
    	<tr align="center" style="background-image:url(css/img/mn_table.png); font-weight:bold; color:#4B4B4B">
        	<td width="50">Mã</td>
            <td width="400">Tên loại</td>
        </tr>
        <?php
        	while($row_lcv = mysql_fetch_array($_lcv))
			{
				ob_start();
		?>
        <tr>
        	<td align="center">{MaLVB}</td>
            <td>{TenLVB}</td>
        </tr>
         <?php
        $s= ob_get_clean();
		$s = str_replace("{MaLVB}",$row_lcv["MaLVB"],$s);
		$s = str_replace("{TenLVB}",$row_lcv["TenLVB"],$s);
		echo $s;
			}
		?>
    </table>
    <div align="right"><a href="index.php?active=danhmuc&pages=dslcv" style="text-decoration:none; color:#039;">Chi tiết ... </a></div>
    <?php
		}
		else
		{
			echo "Danh mục này đang được cập nhật ...<br />";
			echo "<a href='index.php?active=danhmuc&pages=them-loai-cong-van' style='text-decoration:none; color:#039;'>Bấm vào đây</a>";
		}
	?>
</div>
<div class="page_div_danhmuc">
	<center><div class="mndanhmuc">CƠ QUAN</div></center>
    <?php
		$qr ="
				SELECT * FROM coquan limit 0, 4
		";
		$_cq = mysql_query($qr);
		if(mysql_num_rows($_cq) > 0){
	?>
    <table style="margin-top:5px; margin-bottom:5px" border="1">
    	<tr align="center" style="background-image:url(css/img/mn_table.png); font-weight:bold; color:#4B4B4B">
        	<td width="50">Mã</td>
            <td width="400">Cơ quan</td>
        </tr>
        <?php
        	while($row_cq = mysql_fetch_array($_cq))
			{
				ob_start();
		?>
        <tr>
        	<td align="center">{MaCQ}</td>
            <td>{TenCQ}</td>
        </tr>
          <?php
        $s= ob_get_clean();
		$s = str_replace("{MaCQ}",$row_cq["MaCQ"],$s);
		$s = str_replace("{TenCQ}",$row_cq["TenCQ"],$s);
		echo $s;
			}
		?>
    </table>
    <div align="right"><a href="index.php?active=danhmuc&pages=dscq" style="text-decoration:none; color:#039;">Chi tiết ... </a></div>
    <?php
		}
		else
		{
			echo "Danh mục này đang được cập nhật ...<br />";
			echo "<a href='index.php?active=danhmuc&pages=them-co-quan' style='text-decoration:none; color:#039;'>Bấm vào đây</a>";
		}
	?>
</div>
<div class="page_div_danhmuc">
	<center><div class="mndanhmuc">PHÒNG BAN</div></center>
    <?php
		$qr ="
				SELECT * FROM phongban limit 0, 4
		";
		$_pb = mysql_query($qr);
		if(mysql_num_rows($_pb) > 0){
	?>
    <table style="margin-top:5px; margin-bottom:5px" border="1">
    	<tr align="center" style="background-image:url(css/img/mn_table.png); font-weight:bold; color:#4B4B4B">
        	<td width="50">Mã</td>
            <td width="400">Phòng ban</td>
        </tr>
        <?php
        	while($row_pb = mysql_fetch_array($_pb))
			{
				ob_start();
		?>
        <tr>
        	<td align="center">{MaPB}</td>
            <td>{TenPhong}</td>
        </tr>
        <?php
        $s= ob_get_clean();
		$s = str_replace("{MaPB}",$row_pb["MaPB"],$s);
		$s = str_replace("{TenPhong}",$row_pb["TenPhong"],$s);
		echo $s;
			}
		?>
    </table>
    <div align="right"><a href="index.php?active=danhmuc&pages=dspb" style="text-decoration:none; color:#039;">Chi tiết ... </a></div>
    <?php
		}
		else
		{
			echo "Danh mục này đang được cập nhật ...<br />";
			echo "<a href='index.php?active=danhmuc&pages=them-phong-ban' style='text-decoration:none; color:#039;'>Bấm vào đây</a>";
		}
	?>
</div>
<div class="page_div_danhmuc">
	<center><div class="mndanhmuc">CHỨC VỤ</div></center>
     <?php
		$qr ="
				SELECT * FROM chucvu limit 0, 4
		";
		$_cv = mysql_query($qr);
		if(mysql_num_rows($_cv) > 0){
	?>
    <table style="margin-top:5px; margin-bottom:5px" border="1">
    	<tr align="center" style="background-image:url(css/img/mn_table.png); font-weight:bold; color:#4B4B4B">
        	<td width="50">Mã</td>
            <td width="400">Chức vụ</td>
        </tr>
         <?php
        	while($row_cv = mysql_fetch_array($_cv))
			{
				ob_start();
		?>
        <tr>
        	<td align="center">{MaCV}</td>
            <td>{TenCV}</td>
        </tr>
        <?php
        $s= ob_get_clean();
		$s = str_replace("{MaCV}",$row_cv["MaCV"],$s);
		$s = str_replace("{TenCV}",$row_cv["TenCV"],$s);
		echo $s;
			}
		?>
    </table>
    <div align="right"><a href="index.php?active=danhmuc&pages=dscv" style="text-decoration:none; color:#039;">Chi tiết ... </a></div>
    <?php
		}
		else
		{
			echo "Danh mục này đang được cập nhật ...<br />";
			echo "<a href='index.php?active=danhmuc&pages=them-chuc-vu' style='text-decoration:none; color:#039;'>Bấm vào đây</a>";
		}
	?>
</div>
<div class="page_div_danhmuc">
	<center><div class="mndanhmuc">NGƯỜI DÙNG</div></center>
    <?php
		$qr ="
				SELECT * FROM nguoidung limit 0, 4
		";
		$_nd = mysql_query($qr);
		if(mysql_num_rows($_nd) > 0){
			
	?>
    <table style="margin-top:5px; margin-bottom:5px" border="1">
    	<tr align="center" style="background-image:url(css/img/mn_table.png); font-weight:bold; color:#4B4B4B">
        	<td width="50">Mã</td>
            <td width="400">Họ & tên</td>
        </tr>
        <?php
        	while($row_nd = mysql_fetch_array($_nd))
			{
				ob_start();
		?>
        <tr>
        	<td align="center">{MaNSD}</td>
            <td>{HoTenDem} {Ten}</td>
        </tr>
        <?php
        $s= ob_get_clean();
		$s = str_replace("{MaNSD}",$row_nd["MaNSD"],$s);
		$s = str_replace("{HoTenDem}",$row_nd["HoTenDem"],$s);
		$s = str_replace("{Ten}",$row_nd["Ten"],$s);
		echo $s;
			}
		?>
    </table>
    <div align="right"><a href="?active=danhmuc&&pages=dsnd" style="text-decoration:none; color:#039;">Chi tiết ... </a></div>
    <?php
		}
		else
		{
			echo "Danh mục này đang được cập nhật ...<br />";
			echo "<a href='index.php?active=danhmuc&pages=them-nguoi-dung' style='text-decoration:none; color:#039;'>Bấm vào đây</a>";
		}
	?>
</div>

<div class="page_danhmuc_clear"></div>
