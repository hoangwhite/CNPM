<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaPB = $_GET["id"];
	settype($MaPB,"int");
	$row_phongban = QLVB_PhongBan_LaytheoMaPB($MaPB);
?>

<?php
	if(isset($_POST["btnLuu_frmSuaPB"])){
		$_TenPhong = $_POST["txtTen_frmSuaPB"];
		$_GhiChu = $_POST["txtGhichu_frmSuaPB"];
		$_MaCQ = $_POST["listCoquan_frmSuaPB"];
		settype($_MaCQ,"int");
		$_TrangThai = $_POST["rgTinhtrang_frmSuaPB"];
		settype($_TrangThai,"int");
		
		$qr = "
		UPDATE phongban SET
		TenPhong = '$_TenPhong', GhiChu='$_GhiChu', TrangThai='$_TrangThai',MaCQ = '$_MaCQ'
		WHERE MaPB='$MaPB'
		";
		//echo $qr;
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
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=cap-nhat-phong-ban" style="text-decoration: none; color:#000;">Cập nhật phong ban</a></div>
</div>
<div class="page_danhmuc_clear"></div>
<div class="page_ThemND">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬT PHÒNG BAN</div></center>
<form name="frmSuaPB" method="post" action="">
  <table width="440" border="0">
    <tr>
      <td align="right" valign="top">Tên phòng:</td>
      <td><label for="txtTen_frmSuaPB"></label>
      <input type="text" name="txtTen_frmSuaPB" id="txtTen_frmSuaPB" size="25" 
      value="<?php echo $row_phongban['TenPhong']; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ghi chú:</td>
      <td><label for="txtMatkhau_frmThemND"></label>
        <label for="txtGhichu_frmSuaPB"></label>
        <textarea name="txtGhichu_frmSuaPB" id="txtGhichu_frmSuaPB" cols="45" rows="5"><?php echo $row_phongban['GhiChu']; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Cơ quan:</td>
      <td><label for="listCoquan_frmSuaPB"></label>
        <select name="listCoquan_frmSuaPB" id="listCoquan_frmSuaPB">
        <?php
				$_coquan = QLVB_CoQuan_LayTatCa();
				while ($row_coquan = mysql_fetch_array($_coquan)){
  			?>
        <option <?php if($row_phongban["MaCQ"] == $row_coquan['MaCQ']) echo "selected=selected";?> value="<?php echo $row_coquan['MaCQ'] ?>"><?php echo $row_coquan['TenCQ'] ?></option>
        <?php 
				}
		?>
        </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tình trạng:</td>
      <td>
        <label>
          <input name="rgTinhtrang_frmSuaPB" type="radio" id="rgTinhtrang_0" value="1" checked="CHECKED">
          Hoạt động</label>
        <br>
        <label>
          <input type="radio" name="rgTinhtrang_frmSuaPB" value="0" id="rgTinhtrang_1">
          Ngừng hoạt động</label>
        <br>
     </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu_frmSuaPB" id="btnLuu_frmSuaPB" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
