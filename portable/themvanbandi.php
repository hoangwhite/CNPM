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
 $(document).ready(function() {
    $.get("data/coquan.php",function(data){
			$("#idkhoaphong").html(data);
		});
});
 </script>
 <script>
$(function() {
    $( "#txtNgayky" ).datepicker();
  });
</script>
<?php 
	$db_number = 0;
	$cq = QLVB_CoQuan_LayTatCa();
	$MaNSD = $_SESSION["MaNSD"];
	settype($MaNSD,"int");
	if(isset($_POST['btnLuu'])){
		$_tenVB = $_POST['txtTenVB'];
		$_SoHieu = $_POST['txtSohieu'];		
		settype($_SoHieu,"int");
		$_KyHieu = $_POST["txtKyhieu"];
		$_NgayKy = $_POST["txtNgayky"];
		$_ngaygio = date("Y-m-d");
		$_MaLVB = $_POST["listLoaiVB"];
		settype($_MaLVB, "int");
		$_MucDoKhan = $_POST["ListKhan"];
		settype($_MucDoKhan, "int");
		$_MucDoMat = $_POST["listMat"];
		settype($_MucDoMat,"int");
		$_NoiDung = $_POST["txtTrichdan"];
		$_TaiLieuDinhKem = $_FILES['flTailieu']['name'];
		$_CVDiTheoDuong = $_POST["rgTheoduong"];
		settype($_CVDiTheoDuong, "int");
		$_TenNVDi = $_POST["txtNhanvien"];
		$ten_CQ = "";
		while(mysql_fetch_array($cq))
		{
			$temp = "ck_".$db_number;
			if(!empty($_POST[$temp]))
			{
				$ck1 = $_POST[$temp];
				if($ten_CQ == NULL)
				{
					$ten_CQ=$ck1;
				}
				else
				{
					$ten_CQ = $ten_CQ.', '.$ck1;
				}
			}
			$db_number++;
		}
		$_DuyetLanhDao = $_POST["listLanhdaoduyet"];
		$_NoiDungDuyet = $_POST["txtNoidung"];
		$_MaBM = $_POST["rgBieumau"];
		settype($_MaBM,"int");
		$_TenBM = $_POST["txtTenbieumau"];
		$_SoLuong = $_POST["txtSoluong"];
		settype($_SoLuong, "int");
		if($_tenVB == NULL || $_SoHieu == NULL || $_KyHieu == NULL || $_NgayKy == NULL || $_NoiDung == NULL || $ten_CQ == NULL){
			echo "<div class='msg1'> Tên văn bản, số hiệu, ký hiệu, ngày ký, nội dung, tên cơ quan không được rỗng. </div>";
		}
		else if($_NgayKy > $_ngaygio){
			echo "<div class='msg1'> Ngày ký không được lớn hơn ngày hiện tại </div>";
		}
		else if(!ereg('^[0-9]+$',$_SoHieu))
		{
			echo "<div class='msg1'> Số hiệu phải là số.</div>";
		}
		else{
			if($_TaiLieuDinhKem == NULL)// không có tài liệu đính kèm
			{
				if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong == 3)// theo đường bưu điện
				{
					if($_MaBM == 1) // có biểu mẫu
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDiTheoDuong, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_CVDiTheoDuong', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
					else // không biểu mẫu
					{
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDiTheoDuong, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_CVDiTheoDuong', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
				}
				else if($_CVDiTheoDuong==2) // Nhân viên đem đến
				{
					if($_MaBM == 1) // có biểu mẫu
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDiTheoDuong, TenNV, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_CVDiTheoDuong', '$_TenNVDi', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");

					}
					else // không biểu mẫu
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDiTheoDuong, TenNV, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_CVDiTheoDuong', '$_TenNVDi', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
				}
			}
			else // có tài liệu đính kèm
			{
				//Upload tài liệu đính kèm
			 include 'upload/upload.class.php';
			 $upload  = new Upload('flTailieu'); 
			 $upload->setUploadDir('upload/vanbandi/'); 
			 $upload->upload_file(true, 'vbdi_');
			 $_Tailieudinhkem1 = $upload->file_renames;
			 if($upload->isVail() == true){ 
				 echo "<pre>"; 
				 print_r($upload->_errors); 
				 echo "</pre>"; 
			 }else{ 
				 $upload->upload(true,'vbdi_'); 
			 }
				if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong==3)// theo đường bưu điện
				{
					if($_MaBM == 1) // có biểu mẫu
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, TailieuDinhKem , CVDiTheoDuong, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDiTheoDuong', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
					else // không biểu mẫu
					{
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, TailieuDinhKem , CVDiTheoDuong, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDiTheoDuong', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
				}
				else if($_CVDiTheoDuong==2) // Nhân viên đem đến
				{
					if($_MaBM == 1) // có biểu mẫu
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, TailieuDinhKem , CVDiTheoDuong, TenNV, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDiTheoDuong', '$_TenNVDi', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
					else // không biểu mẫu
					{
						$qrvbdi = "
							INSERT INTO vanbandi (TenVB, SoHieu, KyHieu, NgayKy, NgayGoi, MaLVB, MucDoKhan, MucDoMat, MaNSD, NoiDung, TailieuDinhKem , CVDiTheoDuong, TenNV, CQNhan, LanhDaoDuyet, NoiDungDuyet, MaBM) VALUES ('$_tenVB', $_SoHieu, '$_KyHieu', '$_ngaygio', '$_ngaygio', '$_MaLVB', '$_MucDoKhan', '$_MucDoMat', '$MaNSD', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDiTheoDuong', '$_TenNVDi', '$ten_CQ', '$_DuyetLanhDao', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbdi);
						header("location: ?active=vanbandi&pages=van-ban-di");
					}
				}
			}
		}			
	}
?>

 <div class="page_div" style="width:600;margin-bottom:20px; margin-left:20%; margin-top:40px;" >
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM VĂN BẢN ĐI</div></center>
<form action="" method="post" enctype="multipart/form-data" name="frmThamvanbandi">
  <table border="0" width="600">
    <tr>
  	<td width="110" align="right" valign="top"><span class="lb">Tên văn bản:</span></td>
    <td colspan="3"><input name="txtTenVB" type="text" id="txtTenVB" size="44"></td>
    </tr>
  <tr>
    <td align="right" valign="top"><span class="lb">Số hiệu:</span></td>
    <td width="97"><span class="lb1">
      <input name="txtSohieu" type="text" id="txtSohieu" size="10">
    </span></td>
    <td width="85" align="right" valign="top"><span class="lb">Ký hiệu:</span></td>
    <td width="290"><span class="lb1">
      <input name="txtKyhieu" type="text" id="txtKyhieu" size="10">
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><span class="lb">Ngày ký:</span></td>
    <td><span class="lb1">
      <input name="txtNgayky" type="text" id="txtNgayky" size="10" readonly="readonly">
    </span></td>
    <td align="right" valign="top"><span class="lb">Loại văn bản:</span></td>
    <td><span class="lb1">
      <select name="listLoaiVB" id="listLoaiVB">
        <?php
				$_loaivanban = QLVB_LoaiVanBan_LayTatCa();
				while ($row_loaivanban = mysql_fetch_array($_loaivanban)){
  			?>
        <option value="<?php echo $row_loaivanban['MaLVB'] ?>"><?php echo $row_loaivanban['TenLVB'] ?></option>
        <?php 
				}
		?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><span class="lb">Mức độ khẩn:</span></td>
    <td><span class="lb1">
      <select name="ListKhan" id="ListKhan">
        <option value="1">Bình thường</option>
        <option value="2">Khẩn</option>
        <option value="3">Hỏa tốc</option>
      </select>
    </span></td>
    <td align="right" valign="top"><span class="lb">Mức độ mật:</span></td>
    <td><span class="lb1">
      <select name="listMat" id="listMat">
        <option value="1">Bình thường</option>
        <option value="2">Mật</option>
        <option value="3">Tuyệt mật</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top">Trích dẫn:</td>
    <td colspan="3"><textarea name="txtTrichdan" id="txtTrichdan" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td align="right" valign="top">Tài liệu đính kèm:</td>
    <td colspan="3"><label for="flTailieu"></label>
      <input type="file" name="flTailieu" id="flTailieu"></td>
    </tr>
  <tr>
    <td align="right" valign="top">Theo đường:</td>
    <td colspan="3"><div class="divrd">
      <input type="radio" name="rgTheoduong" value="1" id="rgTheoduong_0">
      Bưu điện</div>
      <div class="divrd">
        <input type="radio" name="rgTheoduong" value="2" id="rgTheoduong_1">
        Nhân viên</div>
      <div class="divrd">
        <input type="radio" name="rgTheoduong" value="3" id="rgTheoduong_2" checked="checked">
        Khác</div></td>
    </tr>
  <tr>
    <td align="right" valign="top">Tên nhân viên:</td>
    <td colspan="3"><input name="txtNhanvien" type="text" id="txtNhanvien" size="25"></td>
    </tr>
  <tr>
    <td align="right" valign="top">Cơ quan:</td>
    <td colspan="3"><div style="width:400px; height:100px; overflow:auto;" id="idkhoaphong">    
    </div></td>
    </tr>
  <tr>
    <td align="right" valign="top">Lãnh đạo duyệt:</td>
    <td colspan="3"><select name="listLanhdaoduyet" id="listLanhdaoduyet">
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
    <td colspan="3"><textarea name="txtNoidung" id="txtNoidung" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td align="right" valign="top">Biểu mẫu:</td>
    <td colspan="3"><div class="divrd">
      <input type="radio" name="rgBieumau" value="1" id="rgBieumau_0">
      Có</div>
      <div class="divrd">
        <input type="radio" name="rgBieumau" value="0" id="rgBieumau_1" checked="checked">
        Không</div></td>
    </tr>
  <tr>
    <td align="right" valign="top">Tên biểu mẫu:</td>
    <td colspan="3"><label for="txtTenbieumau"></label>
      <input type="text" name="txtTenbieumau" id="txtTenbieumau">      <label for="txtSoluong"></label></td>
    </tr>
  <tr>
    <td align="right" valign="top">Số lượng:</td>
    <td colspan="3"><input type="text" name="txtSoluong" id="txtSoluong"></td>
    </tr>
  <tr>
    <td colspan="4" align="center" valign="bottom"><input type="submit" name="btnLuu" id="btnLuu" value="Lưu" class="redbtvl"></td>
    </tr>
</table>
</form>
</div>
<div class="page_danhmuc_clear"></div>
