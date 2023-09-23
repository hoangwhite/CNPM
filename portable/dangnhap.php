<?php 
	if(isset($_POST["btnDangnhap_frmDangnhap"])){
		$taikhoan = $_POST["txtTaikhoan_frmDangnhap"];
		$matkhau = md5($_POST["txtMatkhau_frmDangnhap"]);
		$qr ="
				SELECT * FROM nguoidung 
				WHERE TaiKhoan='$taikhoan' 
				AND MatKhau='$matkhau'
		";
		$_users_ = mysql_query($qr);
		if(mysql_num_rows($_users_) == 1){
			$row_user = mysql_fetch_array($_users_);
			$_SESSION["MaNSD"] = $row_user["MaNSD"];
			$_SESSION["TaiKhoan"] = $row_user['TaiKhoan'];
			$_SESSION["HoTenDem"] = $row_user["HoTenDem"];
			$_SESSION["Ten"] = $row_user["Ten"];
			$_SESSION["idGr"] = $row_user["idGr"];
			header ("location:./");
		}
		else
		{
			$msg = "Tài khoản hoặc mật khẩu không đúng.";
		}
	}
?>
<div class="msgs">
<center>
	<?php
		if(isset($_POST["btnDangnhap_frmDangnhap"])){
			echo $msg;
		}
	?></center>
</div>
<div class="dangnhap">
<center><div class="mndanhmuc">ĐĂNG NHẬP HỆ THỐNG</div></center>
    <form id="form1" name="form1" method="post" action="">
      <table width="400" border="0" cellpadding="0" style="margin-top:20px;">
      <tr>
          <td colspan="3" align="right" style="color:#F00">
          </td>
        </tr>
        <tr>
          <td rowspan="3" align="right"><img src="css/img/login.png" width="100" height="100" /></td>
          <td align="right">Tài khoản:</td>
          <td><label for="txtTaikhoan_frmDangnhap"></label>
          <input name="txtTaikhoan_frmDangnhap" type="text" id="txtTaikhoan_frmDangnhap" size="25" /></td>
        </tr>
        <tr>
          <td align="right" style="padding-top:7px">Mật khẩu:</td>
          <td><label for="txtMatkhau_frmDangnhap"></label>
          <input name="txtMatkhau_frmDangnhap" type="password" id="txtMatkhau_frmDangnhap" size="25" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" style="padding-top:10px"><input type="submit" name="btnDangnhap_frmDangnhap" id="btnDangnhap_frmDangnhap" value="Đăng nhập" class="redbtvl" /></td>
        </tr>
      </table>
    </form>
</div>
