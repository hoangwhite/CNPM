<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&&pages=dang-nhap");
	}
	else if($_SESSION["idGr"] !=1)
	{
		header ("location:index.php?active=home&pages=goback");
	}
?>
<?php
	require "lib/trangchu.php";
?>
<?php
	if(isset($_POST["btnLuu_frmThemND"])){
		$_taikhoan = $_POST["txtTaikhoan_frmThemND"];
		$_matkhau = md5($_POST["txtMatkhau_frmThemND"]);
		$_hotendem = $_POST["txtHotenDem_frmThemND"];
		$_ten = $_POST["txtTen_frmThemND"];
		$_ngaysinh = $_POST["txtNgaysinh_frmThemND"];
		//$_ngaysinh = date("Y-m-d",$_POST["txtNgaysinh_frmThemND"]);
		$_diachi = $_POST["txtDiachi_frmThemND"];
		$_gioitinh = $_POST["listGioitinh_frmThemND"];
		settype($_gioitinh,"int");
		$_phongban = $_POST["listPhongban_frmThemND"];
		settype($_phongban,"int");
		$_chucvu = $_POST["listChucvu_frmThemND"];
		settype($_chucvu,"int");
		$_tinhtrang = $_POST["dgTinhtrang_frmThemND"];
		settype($_tinhtrang,"int");
		$_nhomquyen = $_POST["listNhomquyen_frmThemND"];
		settype($_nhomquyen,"int");
		
		$qr = "INSERT INTO nguoidung VALUES (null,'$_taikhoan','$_matkhau','$_hotendem','$_ten','$_ngaysinh','$_diachi',
		'$_gioitinh','$_phongban','$_chucvu','$_tinhtrang','$_nhomquyen')
		";
		//echo $qr;
	  	mysql_query($qr);
		header ("location:index.php?active=danhmuc&&pages=dsnd");
	}	
?>
<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&&pages=dsnd" style="text-decoration: none; color:#000;">Quản lý người dùng</a></div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&&pages=them-nguoi-dung" style="text-decoration: none; color:#000;">Thêm người dùng</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center><div class="mndanhmuc" style="margin-bottom:20px">THÊM NGƯỜI DÙNG</div></center>
<form name="frmThemND" method="post" action="">
  <table width="450" border="0">
    <tr>
      <td align="right" valign="top">Tài khoản:</td>
      <td><label for="txtTaikhoan_frmThemND"></label>
      <input name="txtTaikhoan_frmThemND" type="text" id="txtTaikhoan_frmThemND" size="25"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Mật khẩu:</td>
      <td><label for="txtMatkhau_frmThemND"></label>
      <input name="txtMatkhau_frmThemND" type="password" id="txtMatkhau_frmThemND" size="25"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Họ &amp;tên :</td>
      <td><label for="txtHotenDem_frmThemND"></label>
      <input type="text" name="txtHotenDem_frmThemND" id="txtHotenDem_frmThemND" size="15">
      <input type="text" name="txtTen_frmThemND" id="txtTen_frmThemND" size="5" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ngày sinh:</td>
      <td><label for="txtNgaysinh_frmThemND"></label>
        <input name="txtNgaysinh_frmThemND" type="text" id="txtNgaysinh_frmThemND" size="25"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Địa chỉ:</td>
      <td><label for="txtDiachi_frmThemND"></label>
      <textarea name="txtDiachi_frmThemND" id="txtDiachi_frmThemND" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Giới tính:</td>
      <td><label for="listGioitinh_frmThemND"></label>
        <select name="listGioitinh_frmThemND" id="listGioitinh_frmThemND">
          <option value="1">Nam</option>
          <option value="0">Nữ</option>
        </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Phòng ban:</td>
      <td><label for="listPhongban_frmThemND"></label>
        <select name="listPhongban_frmThemND" id="listPhongban_frmThemND">
        <?php
				$_phongban = QLVB_PhongBan_LayTatCa();
				while ($row_phongban = mysql_fetch_array($_phongban)){
  			?>
        <option value="<?php echo $row_phongban['MaPB'] ?>"><?php echo $row_phongban['TenPhong'] ?></option>
        <?php 
				}
		?>
        
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Chức vụ:</td>
      <td><label for="listChucvu_frmThemND"></label>
        <select name="listChucvu_frmThemND" id="listChucvu_frmThemND">
         <?php
				$_chucvu = QLVB_ChucVu_LayTatCa();
				while ($row_chucvu = mysql_fetch_array($_chucvu)){
  			?>
        <option value="<?php echo $row_chucvu['MaCV'] ?>"><?php echo $row_chucvu['TenCV'] ?></option>
        <?php 
				}
		?>
        
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tình trạng:</td>
      <td><div style="float:left; width:100px">
        <label>
          <input name="dgTinhtrang_frmThemND" type="radio" id="dgTinhtrang_frmThemND_0" value="1" checked="CHECKED">
          Đang làm</label></div>
        <div style="float:left; width:100px">
        <label>
          <input type="radio" name="dgTinhtrang_frmThemND" value="0" id="dgTinhtrang_frmThemND_1">
          Nghỉ việc</label></div>
        </td>
    </tr>
    <tr>
      <td align="right" valign="top">Nhóm quyền:</td>
      <td><label for="listNhomquyen_frmThemND"></label>
        <select name="listNhomquyen_frmThemND" id="listNhomquyen_frmThemND">
         <?php
				$_groupusers = QLVB_groupusers_LayTatCa();
				while ($row_groupusers = mysql_fetch_array($_groupusers)){
  			?>
        <option value="<?php echo $row_groupusers['idGr'] ?>"><?php echo $row_groupusers['GrName'] ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmThemND" id="btnLuu_frmThemND" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
