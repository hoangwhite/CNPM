<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
	else if($_SESSION["idGr"] !=1)
	{
		header ("location:index.php?active=home&pages=goback");
	}
?>
<?php 
	require "lib/trangchu.php";
	$MaCV = $_GET["id"];
	settype($MaCV,"int");
	$row_chucvu = QLVB_ChucVu_LaytheoMaCV($MaCV);
?>
<?php
	if(isset($_POST["btnLuu_frmSuaCV"])){
		$_TenCV = $_POST["txtTen_frmSuaCV"];
		$_GhiChu = $_POST["txtGhichu_frmThemCV"];
		$_TrangThai = $_POST["dgTinhtrang_frmSuaCV"];
		settype($_TrangThai,"int");
			
	$qr = "UPDATE chucvu SET
	 TenCV ='$_TenCV',
	 GhiChu='$_GhiChu',
	 TrangThai='$_TrangThai' 
	 WHERE MaCV= '$MaCV'
	 ";
	//echo $qr;
	mysql_query($qr);
	header ("location:index.php?active=danhmuc&pages=dscv");
	}
?>
<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dscv" style="text-decoration: none; color:#000;"> Quản lý chức vụ</a></div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=cap-nhat-chuc-vu&id=<?php echo $MaCV; ?>" style="text-decoration: none; color:#000;"> Cập nhật chức vụ</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬTCHỨC VỤ</div></center>
<form name="frmSuaCV" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên chức vụ:</td>
      <td><label for="txtTen_frmSuaCV"></label>
      <input name="txtTen_frmSuaCV" type="text" id="txtTen_frmSuaCV" value="<?php echo $row_chucvu['TenCV']; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td>
        <label for="txtGhichu_frmThemCV"></label>
        <textarea name="txtGhichu_frmThemCV" id="txtGhichu_frmThemCV" cols="45" rows="5"><?php echo $row_chucvu['GhiChu']; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tình trạng:</td>
      <td>
        <label>
          <input name="dgTinhtrang_frmSuaCV" type="radio" id="RadioGroup1_0" value="1"
           <?php if($row_chucvu['TrangThai']==1){ echo 'checked=checked';} ?> />
          Hoạt động</label>
        <br />
        <label>
          <input type="radio" name="dgTinhtrang_frmSuaCV" value="0" id="RadioGroup1_1" <?php if($row_chucvu['TrangThai']==0){ echo 'checked=checked';} ?> />
          Ngừng hoạt động</label>
        <br />
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmSuaCV" id="btnLuu_frmSuaCV" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>