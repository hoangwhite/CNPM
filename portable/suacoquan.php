<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php 
	require "lib/trangchu.php";
	$MaCQ = $_GET["id"];
	settype($MaCQ,"int");
	$row_coquan = QLVB_CoQuan_LaytheoMaCQ($MaCQ);
?>
<?php
	if(isset($_POST["btnLuu_frmSuaCQ"])){
		$_TenCQ = $_POST["txtTen_frmSuaCQ"];
		$_DiaChi = $_POST["txtDiachi_frmSuaCQ"];
		$_DienThoai = $_POST["txtDienthoai_frmSuaCQ"];
		$_Fax = $_POST["txtFax_frmSuaCQ"];	
		$_Email = $_POST["txtEmail_frmSuaCQ"];
			
	$qr = "UPDATE coquan SET
	 TenCQ ='$_TenCQ',
	 DiaChi='$_DiaChi',
	 DienThoai='$_DienThoai',
	 Fax='$_Fax',
	 Email='$_Email' 
	 WHERE MaCQ= '$MaCQ '
	 ";
	//echo $qr;
	mysql_query($qr);
	header ("location:index.php?active=danhmuc&pages=dscq");
	}
?>

<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dscq" style="text-decoration: none; color:#000;"> Cơ quan</a></div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=cap-nhat-co-quan&id=<?php echo $MaCQ; ?>" style="text-decoration: none; color:#000;"> Cập nhật cơ quan</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬT CƠ QUAN</div></center>

<form name="frmSuaCQ" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên cơ quan:</td>
      <td><label for="txtTen_frmSuaCQ"></label>
      <input type="text" name="txtTen_frmSuaCQ" id="txtTen_frmSuaCQ" size="35" value="<?php echo $row_coquan["TenCQ"]; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Địa chỉ:</td>
      <td><label for="txtMatkhau_frmThemND"></label>
        <label for="txtDiachi_frmSuaCQ"></label>
        <textarea name="txtDiachi_frmSuaCQ" id="txtDiachi_frmSuaCQ" cols="45" rows="5"><?php echo $row_coquan["DiaChi"]; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Điện thoại:</td>
      <td><label for="txtDienthoai_frmSuaCQ"></label>
      <input type="text" name="txtDienthoai_frmSuaCQ" id="txtDienthoai_frmSuaCQ" 
      value="<?php echo $row_coquan["DienThoai"]; ?>" size="35"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Fax:</td>
      <td><label for="txtFax_frmSuaCQ"></label>
      <input type="text" name="txtFax_frmSuaCQ" id="txtFax_frmSuaCQ" 
      value="<?php echo $row_coquan["Fax"]; ?>" size="35"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Email:</td>
      <td><label for="txtEmail_frmSuaCQ"></label>
      <input type="text" name="txtEmail_frmSuaCQ" id="txtEmail_frmSuaCQ"
       value="<?php echo $row_coquan["Email"]; ?>" size="35"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmSuaCQ" id="btnLuu_frmSuaCQ" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
