<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaCQSuDung = QLVB_CoQuan_CQSuDung();
	$MaCQSD = $MaCQSuDung["MaCQ"];
	$db_number = 0;
	$ten_PB=NULL;
	$phongban = QLVB_PhongBan_LayTheoMaCQ($MaCQSD);
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script>
$(function() {
    $( "#txtNgayky" ).datepicker();
	$( "#txtNgayden" ).datepicker();
	$( "#txtHanxuly" ).datepicker();
  });
</script>

 
  <?php
  	if(isset($_POST["btnLuu"])){
		$_TenVB = $_POST["txtTenVB"];
		$_SoHieu = $_POST["txtSohieu"];
		settype($_SoHieu,"int");
		$_KyHieu = $_POST["txtKyhieu"];
		$_NgayKy = $_POST["txtNgayky"];
		$_NgayDen = $_POST["txtNgayden"];
		$_ngaygio = date("Y-m-d");
		$_MaLVB = $_POST["listLoaiVB"];
		$_MaCQ = $_POST["listCoquan"];
		$_MucDoKhan = $_POST["listMucdokhan"];
		$_MUcDoMat = $_POST["listMucdomat"];
		$_MaNV = $_SESSION["MaNSD"];
		$_NoiDung = $_POST["txtNoidung"];
		$_TaiLieuDinhKem = $_FILES['fileTailieu']['name'];
		$_CVDTheoDuong = $_POST["dgTheoduong"];
		settype($_CVDTheoDuong, "int");
		$_TenNVDen = $_POST["txtNhanvien"];
		$_MaBM = $_POST["dgBieuMau"];
		$_TenBM = $_POST["txtTenBM"];
		$_SoLuong = $_POST["txtSoluong"];
		$_TinhTrangXuLy = $_POST["dgTinhtrangxuly"];
		settype($_TinhTrangXuLy,"int");
		$_HanXuLy = $_POST["txtHanxuly"];
		$_NoiDungXuLy = $_POST["txtNoidungxuly"];
		while(mysql_fetch_array($phongban))
		{
			$temp = "ck_".$db_number;
			if(!empty($_POST[$temp]))
			{
				$ck1 = $_POST[$temp];
				if($ten_PB == NULL)
				{
					$ten_PB=$ck1;
				}
				else
				{
					$ten_PB = $ten_PB.', '.$ck1;
				}
			}
			$db_number++;
		}		
		$_PhongBanXuLy = $ten_PB;
		$_LanhDaoDuyet = $_POST["txtLanhdaoduyet"];
		$_NoiDungDuyet = $_POST["txtNoidungduyet"];
		if($_TenVB == NULL || $_SoHieu == NULL || $_KyHieu == NULL || $_NgayKy == NULL || $_NgayDen == NULL || $_NoiDung== NULL || $_NgayKy == NULL || $_NgayDen == NULL)
		{
			echo "<div class='msgs'><center>Tên vên băn, số hiệu, ký hiệu, ngày ký, ngày đến, nội dung không được để trống.</center></div>";
			//header ("location:index.php?active=vanbanden&pages=them-van-ban-den");
		}
		else if($_NgayDen > $_ngaygio || $_NgayKy > $_ngaygio)
		{
			echo "<div class='msgs'><center>Ngày ký, ngày đến không được lớn hơn ngày hiện tại.</center></div>";
			//header ("location:index.php?active=vanbanden&pages=them-van-ban-den");
		}
		else if(!ereg('^[0-9]+$',$_SoHieu))
		{
			echo "<div class='msgs'><center>Số hiệu phải là số.</center></div>";
		}
		else {
		if($_TaiLieuDinhKem == NULL) //Không có tài liệu đính kèm
		{
			if($_CVDTheoDuong == 1)
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy', '$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
			else if ($_CVDTheoDuong ==2)
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, CVDTheoDuong, TenNVDen,  TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TenNVDen', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung, CVDTheoDuong, TenNVDen,  TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TenNVDen', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
			else
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
		}
		else //Có tài liệu đính kèm
		{
			//Upload tài liệu đính kèm
			 include 'upload/upload.class.php';
			 $upload  = new Upload('fileTailieu'); 
			 $upload->setUploadDir('upload/vanbanden/'); 
			 $upload->upload_file(true, 'vbd_');
			 $_Tailieudinhkem1 = $upload->file_renames;
			 if($upload->isVail() == true){ 
				 echo "<pre>"; 
				 print_r($upload->_errors); 
				 echo "</pre>"; 
			 }else{ 
				 $upload->upload(true,'vbd_'); 
			 }
			if($_CVDTheoDuong == 1) //văn bản đến theo đường Bưu điện
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung,TaiLieuDinhKem, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung',  '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung',  '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
			else if ($_CVDTheoDuong ==2) //văn bản đến theo đường, nhân viên trực tiếp đem đến
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TenNVDen,  TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TenNVDen', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TenNVDen,  TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung', '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TenNVDen', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
			else // văn bản đến theo đường khác
			{
				if($_MaBM == 1) //có biểu mẫu
				{
					 
					$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat, MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy',	'$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung',  '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$MaBM_cuoi')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
				else //không biểu mẫu
				{
						$qrvbd = "
								INSERT INTO vanbanden (TenVB, SoHieu, KyHieu, NgayKy, NgayDen, MaLVB, MaCQ, MucDoKhan, MucDoMat,  MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM) VALUES ('$_TenVB', '$_SoHieu', '$_KyHieu', '$_NgayKy', '$_NgayDen', '$_MaLVB', '$_MaCQ', '$_MucDoKhan', '$_MUcDoMat', '$_MaNV', '$_NoiDung',  '$_Tailieudinhkem1', '$_CVDTheoDuong', '$_TinhTrangXuLy', '$_HanXuLy','$_NoiDungXuLy', '$_PhongBanXuLy', '$_LanhDaoDuyet', '$_NoiDungDuyet', '$_MaBM')
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
				}
			}
		}
		}
	}
  ?>
 
 <script>
 $(document).ready(function() {
    $.get("data/phongban.php",function(data){
			$("#idkhoaphong").html(data);
		});
});
 </script>
<div class="page_div" style="width:887px;margin-bottom:20px; margin-left:4%; margin-top:40px;" id="frmThemvanbanden">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM VĂN BẢN ĐẾN</div></center>
<form action="" method="post" enctype="multipart/form-data" name="frmThemvanbanden" onSubmit="return check()">
 <div style="float:left; width:430px; margin-right:10px;">
  <fieldset >
  <legend>Thông tin văn bản đến</legend>
  <table width="400" border="0">
  <tr>
  <td align="right" valign="top">Tên văn bản:
  </td>
  <td><label for="txtTenVB2"></label>
    <input class="text" name="txtTenVB" type="text" id="txtTenVB2" size="25"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Số hiệu:</td>
    <td><label for="txtSohieu"></label>
      <input  name="txtSohieu" type="text" id="txtSohieu" size="3"> <label for="txtKyhieu"> &nbsp;Ký hiệu: </label>
      <input  name="txtKyhieu" type="text" id="txtKyhieu" size="7">
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Ngày ký:</td>
    <td><label for="txtNgayky"></label>
      <input name="txtNgayky" type="text" id="txtNgayky" size="25" readonly="readonly">
      <div class="msg2" id='z-ngayky'></div>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Ngày đến:</td>
    <td><label for="txtNgayden"></label>
      <input name="txtNgayden" type="text" id="txtNgayden" size="25" readonly="readonly">
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Loại văn bản:</td>
    <td><label for="listLoaiVB"></label>
      <select name="listLoaiVB" id="listLoaiVB">
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
    <td align="right" valign="top">Cơ quan đến:</td>
    <td><label for="listCoquan"></label>
      <select name="listCoquan" id="listCoquan">
      <?php
				$_Coquan = QLVB_CoQuan_LayTatCa();
				while ($row_coquan = mysql_fetch_array($_Coquan)){
  			?>
        <option value="<?php echo $row_coquan['MaCQ'] ?>"><?php echo $row_coquan['TenCQ'] ?></option>
        <?php 
				}
		?>
      </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">Mức độ khẩn:</td>
    <td><label for="listMucdomat"></label>
      <select name="listMucdokhan" id="listMucdokhan">
        <option value="1">Bình thường</option>
        <option value="2">Khẩn</option>
        <option value="3">Hỏa tốc</option>
      </select> 
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Mức độ mật:</td>
    <td>
      <label for="listMucdomat"></label>
      <select name="listMucdomat" id="listMucdomat">
        <option value="1">Bình thường</option>
        <option value="2">Mật</option>
        <option value="3">Tuyệt Mật</option>
      </select>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Nội dung:</td>
    <td><label for="txtNoidung"></label>
      <textarea name="txtNoidung" id="txtNoidung" cols="35" rows="5"></textarea>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Tài liệu:</td>
    <td><label for="fileTailieu"></label>
      <input type="file" name="fileTailieu" id="fileTailieu"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Theo đường:</td>
    <td><div style="float:left; width:90px">
      <label>
        <input type="radio" name="dgTheoduong" value="1" id="dgTheoduong_0">
        Bưu điện</label>
      </div>
      <div style="float:left; width:100px">
      <label>
        <input type="radio" name="dgTheoduong" value="2" id="dgTheoduong_1">
        Nhân viên</label>
      </div>
      <div style="float:left; width:70px">
      <label>
        <input name="dgTheoduong" type="radio" id="dgTheoduong_2" value="3" checked="CHECKED">
        Khác</label></div>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Nhân viên:</td>
    <td><label for="txtNhanvien"></label>
      <input name="txtNhanvien" type="text" id="txtNhanvien" size="25" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Biểu mẫu:</td>
    <td> <div style="float:left; width:50px">
        <input type="radio" name="dgBieuMau" value="1" id="dgBieuMau_0" > có
        </div>
     	<div style="float:left; width:100px">     
        <input name="dgBieuMau" type="radio" id="dgBieuMau_1" value="0" checked="CHECKED"> Không
        </div>
       </td>
  </tr>
  <tr>
    <td align="right" valign="top">Tên BM:</td>
    <td><label for="txtTenBM"></label>
      <input name="txtTenBM" type="text" id="txtTenBM" size="25"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Số lượng:</td>
    <td><label for="txtSoluong"></label>
      <input name="txtSoluong" type="text" id="txtSoluong" size="25"></td>
  </tr>
  </table>
  </fieldset>
  </div>
  <div style="float:left; width:430px">
  <fieldset>
  <legend>Xử lý văn bản &amp; duyệt lãnh đạo</legend>
  <table width="410" border="0">
  <tr>
  <td align="right" valign="top">Tình trạng:
  </td>
  <td><div style="float:left; width:100px">
    <label>
      <input type="radio" name="dgTinhtrangxuly" value="1" id="RadioGroup1_0">
      Đã xử lý</label>
    </div>
    <div style="float:left; width:120px">
    <label>
      <input name="dgTinhtrangxuly" type="radio" id="RadioGroup1_1" value="0" checked="CHECKED">
      Chưa xử lý</label></div>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top">Hạn xử lý:</td>
    <td><label for="txtHanxuly"></label>
      <input name="txtHanxuly" type="text" id="txtHanxuly" size="25" readonly="readonly"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Nội dung:</td>
    <td><label for="txtNoidungxuly"></label>
      <textarea name="txtNoidungxuly" id="txtNoidungxuly" cols="35" rows="5"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">Khoa phòng xử lý:</td>
    <td><div style="width:265px; height:125px; overflow:auto;" id="idkhoaphong">
    
    </div></td>
  </tr>
  <tr>
    <td align="right" valign="top">Lãnh đạo duyệt:</td>
    <td><label for="txtLanhdaoduyet"></label>
      <select name="txtLanhdaoduyet" id="txtLanhdaoduyet">
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
      <textarea name="txtNoidungduyet" id="txtNoidungduyet" cols="35" rows="5"></textarea></td>
  </tr>
  </table>
  </fieldset>
  <fieldset style="margin-top:10px; width:410px">
  <legend></legend>
  <center>
    <label for="lst"></label>
    <input  type="submit" name="btnLuu" value="Lưu" class="redbtvl" />
  </center>
  </fieldset>
  </div>
  <div class="page_danhmuc_clear"></div>
  
</form>
</div>
 <div class="page_danhmuc_clear"></div>