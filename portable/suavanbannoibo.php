<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaVB = $_GET["id"];
	settype($MaVB,"int");
	$row_VBNB = QLVB_VanBanNoiBo_LayTheoMa($MaVB);
	$maBieuMau = $row_VBNB["MaBM"];
	$row_BM = QLVB_BieuMau_LayTheoMa($maBieuMau);
?>

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#txtNgayky" ).datepicker();
  });
  </script>
  <?php 
  if(isset($_POST['btnLuu'])){
	 include 'upload/upload.class.php';
	 $_TenVB = $_POST["txtTenVB"];
	 $_SoHieu = $_POST["txtSohieu"];
	 settype($_SoHieu,"int");
	 $_KyHieu = $_POST["txtKyhieu"];
	 $_NgayKy = $_POST["txtNgayky"];
	 $_NgayLuu = date("Y-m-d");
	 $_loaiVB = $_POST["listLoaivanban"];
	 settype($_loaiVB,"int");
	 $_MaNV = $_SESSION["MaNSD"];
	 settype($_MaNV,"int");
	 $_NoiDung = $_POST["txtNoidung"];
	 $_Tailieudinhkem= $_FILES['flTailieudinhkem']['name'];
	 $_KhoaPhongNhan = $_POST["txtKhoaphongnhan"];
	 $_TenLanhDaoDuyet = $_POST["listTenlanhdaoduyet"];
	 $_NoidungDuyet = $_POST["txtNoidungduyet"];
	 $_BieuMau = $_POST["rgBieumau"];
	 $_TenBieuMau = $_POST["txtTenbieumau"];
	 $_SoLuong = $_POST["txtSoluong"];
	 if($_TenVB == NULL && $_SoHieu == NULL && $_KyHieu==NULL && $_NgayKy==NULL&&$_NoiDung==NULL&&$_KhoaPhongNhan==NULL)
	 {
		 echo "<center><div class='msg'>Tên văn bản, ký hiệu, số hiệu, ngày ký, nội dung, khoa phòng nhận không được để trống.</div></center>";
	 }
	 else if(!ereg('^[0-9]+$',$_SoHieu)){
		 echo "<center><div class='msg'>Số hiệu bắt buộc phải là số.</div></center>";
	 }
	 else
	 {
		 if($_FILES['flTailieudinhkem']['name']==NULL) // không có tài liệu đính kèm
		 {
			 if($_BieuMau == 1)//có biểu mẫu
			 {
				 if($_TenBieuMau == NULL && $_SoLuong == NULL)
				 {
					 echo "<center><div class='msg'>Tên biểu mẫu và số lượng không được bỏ trống.</div></center>";
				 }
				 else if(!ereg('^[0-9]+$',$_SoLuong))
				 {
					 echo "<center><div class='msg'>Số lượng biểu mẫu phải là số.</div></center>";
				 }
				 else
				 {
				 	$qr = "UPDATE bieumau SET TenBM='$_TenBieuMau', SoLuong ='$_SoLuong' Where MaBM = '$maBieuMau'";
					mysql_query($qr);
					$qr1 = "
							UPDATE vanbannoibo SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayLuu='$_NgayLuu', MaLVB='$_loaiVB', MaNSD='$_MaNV', NoiDung='$_NoiDung', PBNhan='$_KhoaPhongNhan', LanhDaoDuyet= '$_TenLanhDaoDuyet', NoiDungDuyet = '$_NoidungDuyet' WHERE MaVB = '$MaVB'
					";
					mysql_query($qr1);
					header ("location:index.php?active=home&pages=van-ban-noi-bo");
				 }
			 }
			 else // không biểu mẫu
			 {
				 $qr1 = "
							UPDATE vanbannoibo SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayLuu='$_NgayLuu', MaLVB='$_loaiVB', MaNSD='$_MaNV', NoiDung='$_NoiDung', PBNhan='$_KhoaPhongNhan', LanhDaoDuyet= '$_TenLanhDaoDuyet', NoiDungDuyet = '$_NoidungDuyet' WHERE MaVB = '$MaVB'
					";
					mysql_query($qr1);
					header ("location:index.php?active=home&pages=van-ban-noi-bo");
			 }
		 }
		 else // có tài liệu đính kèm
		 {
			 if($_Tailieudinhkem == NULL)
			 {
				 echo "<center><div class='msg'>Anh(chị) chưa chon tài liệu đính kèm.</div></center>";
			 }
			 else
				 {
				 if($_BieuMau == 1)//có biểu mẫu
				 {
					 if($_TenBieuMau == NULL && $_SoLuong == NULL)
					 {
						 echo "<center><div class='msg'>Tên biểu mẫu và số lượng không được bỏ trống.</div></center>";
					 }
					 else if(!ereg('^[0-9]+$',$_SoLuong))
					 {
						 echo "<center><div class='msg'>Số lượng biểu mẫu phải là số.</div></center>";
					 }
					 else
					 {
						 $upload  = new Upload('flTailieudinhkem'); 
						 $upload->setUploadDir('upload/vanbannoibo/'); 
						 $upload->upload_file(true, 'vbnb_');
					 	 $_Tailieudinhkem1 = $upload->file_renames;
						 if($upload->isVail() == true){ 
							 echo "<pre>"; 
							 print_r($upload->_errors); 
							 echo "</pre>"; 
						 }else{ 
							 $upload->upload(true,'vbnb_'); 
						 }
						$qr = "UPDATE bieumau SET TenBM='$_TenBieuMau', SoLuong ='$_SoLuong' Where MaBM = '$maBieuMau'";
						mysql_query($qr);
						$qr1 = "
								UPDATE vanbannoibo SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayLuu='$_NgayLuu', MaLVB='$_loaiVB', MaNSD='$_MaNV', NoiDung='$_NoiDung',TailieuDinhKem= '$_Tailieudinhkem1' , PBNhan= '$_KhoaPhongNhan', LanhDaoDuyet= '$_TenLanhDaoDuyet', NoiDungDuyet = '$_NoidungDuyet' WHERE MaVB = '$MaVB'								
						";
						mysql_query($qr1);
						header ("location:index.php?active=home&pages=van-ban-noi-bo");
					 }
				 }
				 else // không biểu mẫu
				 {
					 $upload  = new Upload('flTailieudinhkem'); 
					 $upload->setUploadDir('upload/vanbannoibo/'); 
					 $upload->upload_file(true, 'vbnb_');
					 $_Tailieudinhkem1 = $upload->file_renames;
					 if($upload->isVail() == true){ 
						 echo "<pre>"; 
						 print_r($upload->_errors); 
						 echo "</pre>"; 
					 }else{ 
						 $upload->upload(true,'vbnb_'); 
					 }
					 $qr1 = "
								UPDATE vanbannoibo SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayLuu='$_NgayLuu', MaLVB='$_loaiVB', MaNSD='$_MaNV', NoiDung='$_NoiDung',TailieuDinhKem= '$_Tailieudinhkem1' , PBNhan= '$_KhoaPhongNhan', LanhDaoDuyet= '$_TenLanhDaoDuyet', NoiDungDuyet = '$_NoidungDuyet' WHERE MaVB = '$MaVB'
						";
					mysql_query($qr1);
					header ("location:index.php?active=home&pages=van-ban-noi-bo");
				 }
			}
		 }
	 }
  }
?>

<div class="page_danhmuc_clear"></div>
<div class="page_ThemND" style="width:600px; margin-bottom:20px; background-image:url(css/img/background.png)">
<center><div class="mndanhmuc" style="margin-bottom:20px">THÊM VĂN BẢN NỘI BỘ</div></center>
<form name="frmSuavanbannoibo" method="post" action="" enctype="multipart/form-data">
  <table width="570" border="0">
   <tr>
      <td width="167" align="right" valign="top">Tên văn bản:</td>
      <td width="423">
      <input type="text" name="txtTenVB" id="txtTenVB" size="28" value="<?php echo $row_VBNB["TenVB"]; ?>">
      <span class="msg1">(*)</span></td>
    </tr>
    <tr>
      <td width="167" align="right" valign="top">Số hiệu:</td>
      <td width="423"><label for="txtSohieu"></label>
      <input type="text" name="txtSohieu" id="txtSohieu" size="4" value="<?php echo $row_VBNB["SoHieu"]; ?>"> 
      <span class="msg1">(*)</span>
      <label for="txtKyhieu"> Ký hiệu: </label>
      <input type="text" name="txtKyhieu" id="txtKyhieu" size="6" value="<?php echo $row_VBNB["KyHieu"]; ?>"><span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ngày ký:</td>
      <td>
      <input type="text" name="txtNgayky" id="txtNgayky" readonly="readonly" size="28" value="<?php echo $row_VBNB["NgayKy"]; ?>"/>
      <span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Loại văn bản:</td>
      <td><label for="listLoaivanban"></label>
        <select name="listLoaivanban" id="listLoaivanban" style="width:229px;">
         <?php
				$_loaivanban = QLVB_LoaiVanBan_LayTatCa();
				while ($row_loaivanban = mysql_fetch_array($_loaivanban)){
  			?>
        <option <?php if($row_VBNB["MaLVB1"] == $row_loaivanban["MaLVB"]){echo "selected=selected";} ?> value="<?php echo $row_loaivanban['MaLVB']; ?>"><?php echo $row_loaivanban['TenLVB']; ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Nội dung:</td>
      <td valign="top"><label for="txtNoidung"></label>
      <textarea name="txtNoidung" id="txtNoidung" cols="45" rows="5"><?php echo $row_VBNB['NoiDung']; ?></textarea>
      <span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tài liệu đính kèm:</td>
      <td><label for="txtTailieudinhkem"></label>
      <input type="file" name="flTailieudinhkem" id="flTailieudinhkem" <?php echo $row_VBNB["TailieuDinhKem"];  ?> ></td>
    </tr>
    <tr>
      <td align="right" valign="top">Khoa phòng nhận:</td>
      <td valign="top"><label for="txtKhoaphongnhan"></label>
        <textarea name="txtKhoaphongnhan" id="txtKhoaphongnhan" cols="45" rows="5"><?php echo $row_VBNB['PBNhan']; ?></textarea>
        <span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tên lãnh đạo duyệt:</td>
      <td><label for="listTenlanhdaoduyet"></label>
        <select name="listTenlanhdaoduyet" id="listTenlanhdaoduyet" style="width:229px;">
        <?php
				$_nguoidung = QLVB_NguoiDung_LayTatCaDuyetLanhDao();
				while ($row_nguoidung = mysql_fetch_array($_nguoidung)){
					
  			?>
        <option <?php if($row_VBNB["LanhDaoDuyet"] == $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']){echo "selected=selected";} ?> value="<?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?>"><?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Nội dung duyệt:</td>
      <td><label for="txtNoidungduyet"></label>
      <textarea name="txtNoidungduyet" id="txtNoidungduyet" cols="45" rows="5"><?php echo $row_VBNB['NoiDungDuyet']; ?></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Biểu mẫu:</td>
      <td><div style="float:left; width:70px;">        
          <input <?php if($row_VBNB["MaBM"] > 0){echo "checked=checked";} ?> type="radio" name="rgBieumau" value="1" id="rgBieumau_0"> Có
          </div>
          <div style="float:left; width:80px;">
        
          <input <?php if($row_VBNB["MaBM"] == 0){echo "checked=checked";} ?> type="radio" name="rgBieumau" value="0" id="rgBieumau_1" />Không
          </div>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top">Tên biểu mẫu:</td>
      <td><label for="txtTenbieumau"></label>
      <input type="text" name="txtTenbieumau" id="txtTenbieumau" size="28" value="<?php echo $row_BM["TenBM"]; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Số lượng:</td>
      <td><label for="txtSoluong"></label>
      <input name="txtSoluong" type="text" id="txtSoluong" size="28" value="<?php echo $row_BM["SoLuong"]; ?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu" id="btnLuu" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
