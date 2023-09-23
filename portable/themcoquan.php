<?php
	if(isset($_POST["btnLuu_frmThemCQ"])){
		$_TenCQ = $_POST["txtTen_frmThemCQ"];
		$_DiaChi = $_POST["txtDiachi_frmThemCQ"];
		$_DienThoai = $_POST["txtDienthoai_frmThemCQ"];
		$_Fax = $_POST["txtFax_frmThemCQ"];	
		$_Email = $_POST["txtEmail_frmThemCQ"];
			
	$qr = "INSERT INTO coquan VALUES (null,'$_TenCQ','$_DiaChi','$_DienThoai','$_Fax','$_Email')";
	//echo $qr;
	mysql_query($qr);
	header ("location:index.php?active=danhmuc&pages=dscq");
	}
?>

<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="./?active=danhmuc&amp;&amp;pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
    <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="./?active=danhmuc&amp;&amp;pages=dscq" style="text-decoration: none; color:#000;"> Cơ quan</a></div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="./?active=danhmuc&amp;&amp;pages=them-co-quan" style="text-decoration: none; color:#000;"> Thêm cơ quan</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM CƠ QUAN</div></center>

<form name="frmThemCQ" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên cơ quan:</td>
      <td><label for="txtTen_frmThemCQ"></label>
      <input type="text" name="txtTen_frmThemCQ" id="txtTen_frmThemCQ" size="35"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Địa chỉ:</td>
      <td><label for="txtMatkhau_frmThemND"></label>
        <label for="txtDiachi_frmThemCQ"></label>
        <textarea name="txtDiachi_frmThemCQ" id="txtDiachi_frmThemCQ" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Điện thoại:</td>
      <td><label for="txtDienthoai_frmThemCQ"></label>
      <input type="text" name="txtDienthoai_frmThemCQ" id="txtDienthoai_frmThemCQ" size="35"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Fax:</td>
      <td><label for="txtFax_frmThemCQ"></label>
      <input type="text" name="txtFax_frmThemCQ" id="txtFax_frmThemCQ" size="35"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Email:</td>
      <td><label for="txtEmail_frmThemCQ"></label>
      <input type="text" name="txtEmail_frmThemCQ" id="txtEmail_frmThemCQ" size="35"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmThemCQ" id="btnLuu_frmThemCQ" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
