<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	if(isset($_POST["btnLuu_frmThemLCV"])){
		$_TenLVB = $_POST["txtTenloai_frmThemLCV"];
		$_GhiChu = $_POST["txtGhichu_frmThemLCV"];
	$qr = "INSERT INTO loaivanban VALUES (null,'$_TenLVB','$_GhiChu','1')";
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
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=them-loai-cong-van" style="text-decoration: none; color:#000;"> Thêm loại văn bản</a></div>
</div>
<div class="page_danhmuc_clear"></div>

<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM LOẠI VĂN BẢN</div></center>

<form method="post" action="" name="frmThemLCV">
  <table width="500" border="0">
    <tr>
      <td align="right" valign="top">Tên loại:</td>
      <td><label for="txtTenloai_frmThemLCV"></label>
      <input size="25" type="text" name="txtTenloai_frmThemLCV" id="txtTenloai_frmThemLCV"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td><label for="txtGhichu_frmThemLCV"></label>
      <textarea name="txtGhichu_frmThemLCV" id="txtGhichu_frmThemLCV" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmThemLCV" id="btnLuu_frmThemLCV" value="Lưu"></td>
    </tr>
  </table>
</form>

</div>
