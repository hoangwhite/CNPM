<?php
	require "lib/trangchu.php";
?>
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
?>
<?php 
	$MaNSD = $_GET["id"];
	settype($MaNSD,"int");
	$row_nguoidung = QLVB_NguoiDung_LaytheoMaNSD($MaNSD);
?>

<?php
	if(isset($_POST["btnLuu_frmSuaND"])){
		$_taikhoan = $_POST["txtTaikhoan_frmSuaND"];
		$_hotendem = $_POST["txtHotenDem_frmSuaND"];
		$_ten = $_POST["txtTen_frmSuaND"];
		$_ngaysinh = $_POST["txtNgaysinh_frmSuaND"];
		$_diachi = $_POST["txtDiachi_frmSuaND"];
		$_gioitinh = $_POST["listGioitinh_frmSuaND"];
		settype($_gioitinh,"int");
		$_phongban = $_POST["listPhongban_frmSuaND"];
		settype($_phongban,"int");
		$_chucvu = $_POST["listChucvu_frmSuaND"];
		settype($_chucvu,"int");
		$_tinhtrang = $_POST["dgTinhtrang_frmSuaND"];
		settype($_tinhtrang,"int");
		$_nhomquyen = $_POST["listNhomquyen_frmSuaND"];
		settype($_nhomquyen,"int");
		
		$qr = "
		UPDATE nguoidung SET
		TaiKhoan = '$_taikhoan', HoTenDem='$_hotendem', Ten = '$_ten', NamSinh='$_ngaysinh', DiaChi='$_diachi',
		GioiTinh='$_gioitinh', MaPB='$_phongban', MaCV='$_chucvu', TrangThaiLamViec='$_tinhtrang', idGr='$_nhomquyen'
		WHERE MaNSD='$MaNSD'
		";
		//echo $qr;
	  	mysql_query($qr);
		header ("location:index.php?active=danhmuc&pages=dsnd");
	}	
?>
<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dsnd" style="text-decoration: none; color:#000;"> Quản lý người dùng</a></div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=cap-nhat-nguoi-dung&id=<?php echo $MaNSD; ?>" style="text-decoration: none; color:#000;">Cập nhật người dùng</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬT NGƯỜI DÙNG</div></center>
<form name="frmSuaND" method="post" action="">
  <table width="450" border="0">
  	<tr>
      <td align="right" valign="top">ID:</td>
      <td><label for="txtId_frmSuaND"></label>
      <input name="txtId_frmSuaND" type="text" id="txtId_frmSuaND" size="5" readonly="readonly" value="<?php echo $MaNSD; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tài khoản:</td>
      <td><label for="txtId_frmSuaND"></label>
      <input name="txtTaikhoan_frmSuaND" type="text" 
      id="txtTaikhoan_frmSuaND" value="<?php echo $row_nguoidung["TaiKhoan"]; ?>" size="25" readonly="readonly"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Họ &amp;tên:</td>
      <td><label for="txtHotenDem_frmSuaND"></label>
        <input type="text" name="txtHotenDem_frmSuaND" id="txtHotenDem_frmSuaND" 
        value="<?php echo $row_nguoidung["HoTenDem"]; ?>" size="15" />
        <input type="text" name="txtTen_frmSuaND" id="txtTen_frmSuaND" 
        value="<?php echo $row_nguoidung["Ten"]; ?>" size="5" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ngày sinh:</td>
      <td><label for="txtNgaysinh_frmSuaND"></label>
        <input name="txtNgaysinh_frmSuaND" type="text" id="txtNgaysinh_frmSuaND" 
        value="<?php echo $row_nguoidung["NamSinh"]; ?>" size="25" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Địa chỉ:</td>
      <td><label for="txtDiachi_frmSuaND"></label>
      <textarea name="txtDiachi_frmSuaND" id="txtDiachi_frmSuaND" cols="45" rows="5"><?php echo $row_nguoidung["DiaChi"]; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Giới tính:</td>
      <td><label for="listGioitinh_frmSuaND"></label>
        <select name="listGioitinh_frmSuaND"  id="listGioitinh_frmSuaND">
          <option <?php if($row_nguoidung["GioiTinh"] == 1) echo "selected=selected";?> value="1">Nam</option>
          <option <?php if($row_nguoidung["GioiTinh"] == 0) echo "selected=selected";?> value="0">Nữ</option>
        </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Phòng ban:</td>
      <td><label for="listPhongban_frmSuaND"></label>
        <select name="listPhongban_frmSuaND" id="listPhongban_frmSuaND">
        <?php
				$_phongban = QLVB_PhongBan_LayTatCa();
				while ($row_phongban = mysql_fetch_array($_phongban)){
  			?>
        <option <?php if($row_nguoidung["MaPB"] == $row_phongban['MaPB']) echo "selected=selected";?> value="<?php echo $row_phongban['MaPB']; ?>"><?php echo $row_phongban['TenPhong']; ?></option>
        <?php 
				}
		?>
        
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Chức vụ:</td>
      <td><label for="listChucvu_frmSuaND"></label>
        <select name="listChucvu_frmSuaND" id="listChucvu_frmSuaND">
         <?php
				$_chucvu = QLVB_ChucVu_LayTatCa();
				while ($row_chucvu = mysql_fetch_array($_chucvu)){
  			?>
        <option <?php if($row_nguoidung["MaCV"] == $row_chucvu['MaCV']) echo "selected=selected";?> value="<?php echo $row_chucvu['MaCV']; ?>"><?php echo $row_chucvu['TenCV']; ?></option>
        <?php 
				}
		?>
        
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tình trạng:</td>
      <td><div style="float:left; width:100px">
        <label>
          <input name="dgTinhtrang_frmSuaND" type="radio" id="dgTinhtrang_frmSuaND_0" value="1"
          <?php if($row_nguoidung["TrangThaiLamViec"] == 1) echo "checked=CHECKED";?> />
          Đang làm</label></div>
        <div style="float:left; width:100px">
        <label>
          <input type="radio" name="dgTinhtrang_frmSuaND" value="0" id="dgTinhtrang_frmSuaND_1" <?php if($row_nguoidung["TrangThaiLamViec"] == 0) echo "checked=CHECKED";?> />
          Nghỉ việc</label></div>
        </td>
    </tr>
    <tr>
      <td align="right" valign="top">Nhóm quyền:</td>
      <td><label for="listNhomquyen_frmSuaND"></label>
        <select name="listNhomquyen_frmSuaND" id="listNhomquyen_frmSuaND">
         <?php
				$_groupusers = QLVB_groupusers_LayTatCa();
				while ($row_groupusers = mysql_fetch_array($_groupusers)){
  			?>
        <option <?php if($row_nguoidung["idGr"] == $row_groupusers['idGr']) echo "selected=selected";?> value="<?php echo $row_groupusers['idGr']; ?>"><?php echo $row_groupusers['GrName']; ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmSuaND" id="btnLuu_frmSuaND" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
<?php } ?>
