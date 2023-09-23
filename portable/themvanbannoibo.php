<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
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
				 	$qr = "INSERT INTO bieumau VALUES (null,'$_TenBieuMau','$_SoLuong')";
					mysql_query($qr);
					$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
					$MaBM_cuoi = $row_bieumau['MaBM'];
					settype($MaBM_cuoi,"int");
					$qr1 = "
							INSERT INTO vanbannoibo (TenVB, SoHieu, KyHieu, NgayKy, NgayLuu, MaLVB, MaNSD, NoiDung, 		                            PBNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', 	                            '$_NgayKy',	'$_NgayLuu', '$_loaiVB', '$_MaNV', '$_NoiDung', '$_KhoaPhongNhan', '$_TenLanhDaoDuyet', '$_NoidungDuyet', '$MaBM_cuoi')
					";
					mysql_query($qr1);
					header ("location:index.php?active=home&pages=van-ban-noi-bo");
				 }
			 }
			 else // không biểu mẫu
			 {
				 $qr1 = "
							INSERT INTO vanbannoibo (TenVB, SoHieu, KyHieu, NgayKy, NgayLuu, MaLVB, MaNSD, NoiDung, 		                            PBNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', 	                            '$_NgayKy',	'$_NgayLuu', '$_loaiVB', '$_MaNV', '$_NoiDung', '$_KhoaPhongNhan', '$_TenLanhDaoDuyet',
							'$_NoidungDuyet', '$_BieuMau')
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
							 echo $_Tailieudinhkem1;
						 }
						$qr = "INSERT INTO bieumau VALUES (null,'$_TenBieuMau','$_SoLuong')";
						mysql_query($qr);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qr1 = "
								INSERT INTO vanbannoibo (TenVB, SoHieu, KyHieu, NgayKy, NgayLuu, MaLVB, MaNSD, NoiDung, TailieuDinhKem, PBNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayLuu', '$_loaiVB', '$_MaNV', '$_NoiDung', '$_Tailieudinhkem1', '$_KhoaPhongNhan', '$_TenLanhDaoDuyet', '$_NoidungDuyet', '$MaBM_cuoi')
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
								INSERT INTO vanbannoibo (TenVB, SoHieu, KyHieu, NgayKy, NgayLuu, MaLVB, MaNSD, NoiDung, TailieuDinhKem, PBNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy', '$_NgayLuu', '$_loaiVB', '$_MaNV', '$_NoiDung', '$_Tailieudinhkem1', '$_KhoaPhongNhan', '$_TenLanhDaoDuyet', '$_NoidungDuyet', '$_BieuMau')
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
<form name="frmThemvanbannoibo" method="post" action="" enctype="multipart/form-data">
  <table width="570" border="0">
   <tr>
      <td width="167" align="right" valign="top">Tên văn bản:</td>
      <td width="423">
      <input type="text" name="txtTenVB" id="txtTenVB" size="28">
      <span class="msg1">(*)</span></td>
    </tr>
    <tr>
      <td width="167" align="right" valign="top">Số hiệu:</td>
      <td width="423"><label for="txtSohieu"></label>
      <input type="text" name="txtSohieu" id="txtSohieu" size="4"> 
      <span class="msg1">(*)</span>
      <label for="txtKyhieu"> Ký hiệu: </label>
      <input type="text" name="txtKyhieu" id="txtKyhieu" size="6"><span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Ngày ký:</td>
      <td>
      <input type="text" name="txtNgayky" id="txtNgayky" readonly="readonly" size="28"/>
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
        <option value="<?php echo $row_loaivanban['MaLVB'] ?>"><?php echo $row_loaivanban['TenLVB'] ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Nội dung:</td>
      <td valign="top"><label for="txtNoidung"></label>
      <textarea name="txtNoidung" id="txtNoidung" cols="45" rows="5"></textarea>
      <span class="msg1"> (*)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tài liệu đính kèm:</td>
      <td><label for="txtTailieudinhkem"></label>
      <input type="file" name="flTailieudinhkem" id="flTailieudinhkem"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Khoa phòng nhận:</td>
      <td valign="top"><label for="txtKhoaphongnhan"></label>
        <textarea name="txtKhoaphongnhan" id="txtKhoaphongnhan" cols="45" rows="5"></textarea>
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
        <option value="<?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?>"><?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?></option>
        <?php 
				}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Nội dung duyệt:</td>
      <td><label for="txtNoidungduyet"></label>
      <textarea name="txtNoidungduyet" id="txtNoidungduyet" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">Biểu mẫu:</td>
      <td><div style="float:left; width:70px;">        
          <input type="radio" name="rgBieumau" value="1" id="rgBieumau_0"> Có
          </div>
          <div style="float:left; width:80px;">
        
          <input type="radio" name="rgBieumau" value="0" id="rgBieumau_1" checked="checked" />Không
          </div>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top">Tên biểu mẫu:</td>
      <td><label for="txtTenbieumau"></label>
      <input type="text" name="txtTenbieumau" id="txtTenbieumau" size="28"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Số lượng:</td>
      <td><label for="txtSoluong"></label>
      <input name="txtSoluong" type="text" id="txtSoluong" size="28"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="redbtvl" type="submit" name="btnLuu" id="btnLuu" value="Lưu"></td>
    </tr>
  </table>
</form>
</div>
