<?php
	if(isset($_POST["btnDangxuat_frmdangxuat"])){
		unset( $_SESSION["MaNSD"]);
		unset( $_SESSION["TaiKhoan"]);
		unset ($_SESSION["HoTenDem"]);
		unset ($_SESSION["Ten"]);
		unset ($_SESSION["idGr"]);
		header ("location:?active=home&&pages=dang-nhap");
	}
?>
<form id="frmdangxuat" name="frmdangxuat" method="post" action="">
<?php
	if(isset($_SESSION["MaNSD"])){
		echo "Chào bạn: ".$_SESSION["HoTenDem"]." ".$_SESSION["Ten"]."\n";  
	?>
    <div>
		<input class="buttons" type="submit" name="btnDangxuat_frmdangxuat" id="btnDangxuat_frmdangxuat" value="Đăng xuất" /></div>
	<?php
	}
	else {
   ?>
   <a href="?active=home&&pages=dang-nhap" style="text-decoration:none; color:white; font-weight:bold">[ Đăng nhập ]</a> 
   <?php
	}
?>
</form>
