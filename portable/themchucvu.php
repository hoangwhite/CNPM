<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
?>
<?php
	if(isset($_POST["btnLuu_frmThemCV"])){
		$_TenCV = $_POST["txtTen_frmThemCV"];
		$_GhiChu = $_POST["txtGhichu_frmThemCV"];
	$qr = "INSERT INTO chucvu VALUES (null,'$_TenCV','$_GhiChu','1')";
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
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=them-chuc-vu" style="text-decoration: none; color:#000;"> Thêm chức vụ</a></div>
</div>
<div class="page_danhmuc_clear"></div>

<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM CHỨC VỤ</div></center>
<form name="frmThemCV" method="post" action="">
  <table width="500" border="0">
    <tr>
      <td width="124" align="right" valign="top">Tên chức vụ:</td>
      <td width="306"><label for="txtTen_frmThemCV"></label>
      <input type="text" name="txtTen_frmThemCV" id="txtTen_frmThemCV"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td>
        <label for="txtGhichu_frmThemCV"></label>
        <textarea name="txtGhichu_frmThemCV" id="txtGhichu_frmThemCV" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmThemCV" id="btnLuu_frmThemCV" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>