<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php 
	require "lib/trangchu.php";
	$MaLVB = $_GET["id"];
	settype($MaLVB,"int");
	$row_lcv = QLVB_LoaiCongVan_LaytheoMaLCV($MaLVB);
?>
<?php
	if(isset($_POST["btnLuu_frmSuaLCV"])){
		$_TenLCV = $_POST["txtTen_frmSuaLCV"];
		$_GhiChu = $_POST["txtGhichu_frmThemLCV"];
		$_TrangThai = $_POST["dgTinhtrang_frmSuaLCV"];
		settype($_TrangThai,"int");
			
	$qr = "UPDATE loaivanban SET
	 TenLVB ='$_TenLCV',
	 GhiChu='$_GhiChu',
	 TrangThai='$_TrangThai' 
	 WHERE MaLVB= '$MaLVB'
	 ";
	//echo $qr;
	mysql_query($qr);
	header ("location:index.php?active=danhmuc&pages=dslcv");
	}
?>
<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dslcv" style="text-decoration: none; color:#000;">Quản lý loại văn bản</a></div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=cap-nhat-loai-cong-văn&id=<?php echo $MaLVB; ?>" style="text-decoration: none; color:#000;">Cập nhật loại văn bản</a></div>
</div>
<div class="page_danhmuc_clear"></div>

<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬT LOẠI VĂN BẢN</div></center>

<form name="frmSuaCV" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên chức vụ:</td>
      <td><label for="txtTen_frmSuaLCV"></label>
      <input name="txtTen_frmSuaLCV" type="text" id="txtTen_frmSuaLCV" value="<?php echo $row_lcv['TenLVB']; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td>
        <label for="txtGhichu_frmThemLCV"></label>
        <textarea name="txtGhichu_frmThemLCV" id="txtGhichu_frmThemLCV" cols="45" rows="5"><?php echo $row_lcv['GhiChu']; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tình trạng:</td>
      <td>
        <label>
          <input name="dgTinhtrang_frmSuaLCV" type="radio" id="RadioGroup1_0" value="1"
           <?php if($row_lcv['TrangThai']==1){ echo 'checked=checked';} ?> />
          Hoạt động</label>
        <br />
        <label>
          <input type="radio" name="dgTinhtrang_frmSuaLCV" value="0" id="RadioGroup1_1" <?php if($row_lcv['TrangThai']==0){ echo 'checked=checked';} ?> />
          Ngừng hoạt động</label>
        <br />
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmSuaLCV" id="btnLuu_frmSuaLCV" value="Lưu"></td>
    </tr>
  </table>
</form>

</div>