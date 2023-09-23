<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
?>
<?php
	if(isset($_POST["btnLuu_frmThemPB"])){
		$_TenPhong = $_POST["txtTen_frmThemPB"];
		$_GhiChu = $_POST["txtGhichu_frmThemPB"];
		$_MaCQ = $_POST["listCoquan_frmThemPB"];
		settype($_MaCQ,"int");			
	$qr = "INSERT INTO phongban VALUES (null,'$_TenPhong','$_GhiChu','1','$_MaCQ')";
	mysql_query($qr);
	header ("location:index.php?active=danhmuc&pages=dspb");
	}
?>

<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dspb" style="text-decoration: none; color:#000;">Quản lý phong ban</a></div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=them-phong-ban" style="text-decoration: none; color:#000;">Thêm phong ban</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM PHÒNG BAN</div></center>
<form name="frmThemPB" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên phòng:</td>
      <td><label for="txtTen_frmThemPB"></label>
      <input type="text" name="txtTen_frmThemPB" id="txtTen_frmThemPB" size="25"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td><label for="txtMatkhau_frmThemND"></label>
        <label for="txtGhichu_frmThemPB"></label>
        <textarea name="txtGhichu_frmThemPB" id="txtGhichu_frmThemPB" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Cơ quan:</td>
      <td><label for="listCoquan_frmThemPB"></label>
        <select name="listCoquan_frmThemPB" id="listCoquan_frmThemPB">
        <?php
				$_coquan = QLVB_CoQuan_LayTatCa();
				while ($row_coquan = mysql_fetch_array($_coquan)){
  			?>
        <option value="<?php echo $row_coquan['MaCQ'] ?>"><?php echo $row_coquan['TenCQ'] ?></option>
        <?php 
				}
		?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmThemPB" id="btnLuu_frmThemPB" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
