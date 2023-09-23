<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaVB = $_GET["id"];
	settype($MaVB,"int");
	$row_VBD = QLVB_VanBanDen_LayTheoMa($MaVB);
	$maBieuMau = $row_VBD["MaBM"];
	settype($maBieuMau,"int");
	$row_BM = QLVB_BieuMau_LayTheoMa($maBieuMau);
	$row_bieumau_TatCa = QLVB_BieuMau_LayTatCa()
	
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
		$_MaLVB = $_POST["listLoaiVB"];
		settype($_MaLVB,"int");
		$_MaCQ = $_POST["listCoquan"];
		settype($_MaCQ,"int");
		$_MucDoKhan = $_POST["listMucdokhan"];
		settype($_MucDoKhan,"int");
		$_MucDoMat = $_POST["listMucdomat"];
		settype($_MucDoMat,"int");
		$_MaNV = $_SESSION["MaNSD"];
		settype($_MaNV,"int");
		$_NoiDung = $_POST["txtNoidung"];
		$_TaiLieuDinhKem = $_FILES['fileTailieu']['name'];
		$_CVDTheoDuong = $_POST["dgTheoduong"];
		settype($_CVDTheoDuong, "int");
		$_TenNVDen = $_POST["txtNhanvien"];
		$_MaBM = $_POST["dgBieuMau"];
		settype($_MaBM,"int");
		$_TenBM = $_POST["txtTenBM"];
		$_SoLuong = $_POST["txtSoluong"];
		settype($_SoLuong,"int");
		$_TinhTrangXuLy = $_POST["dgTinhtrangxuly"];
		settype($_TinhTrangXuLy,"int");
		$_HanXuLy = $_POST["txtHanxuly"];
		$_NoiDungXuLy = $_POST["txtNoidungxuly"];
		$_PhongBanXuLy = $_POST["txtKhoaphongxuly"];
		$_LanhDaoDuyet = $_POST["txtLanhdaoduyet"];
		$_NoiDungDuyet = $_POST["txtNoidungduyet"];
		if($_TaiLieuDinhKem == NULL) //Không có tài liệu đính kèm
		{
			if($_CVDTheoDuong == 2) // nhân văn trực tiếp đem văn bản đến
			{
				if($_MaBM == 1)
				{
					if($maBieuMau==0) // thêm mới biểu mẫu nhưng cập nhật lại văn bản đến
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='$MaBM_cuoi' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhật lại biểu mẫu và văn bản đến
					{
						$qrbm = "UPDATE bieumau SET TenBM='$_TenBM', SoLuong='$_SoLuong' WHERE MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
				else
				{
					if($maBieuMau > 0) // xóa bỏ biểu mẫu này và cập nhật lại văn bản đến
					{
						$qrbm = "DELETE from bieumau Where MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='0' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhận lại văn bản đến
					{
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
			}
			else // theo đường khác
			{
				if($_MaBM == 1)
				{
					if($maBieuMau==0) // thêm mới biểu mẫu nhưng cập nhật lại văn bản đến
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='$MaBM_cuoi' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhật lại biểu mẫu và văn bản đến
					{
						$qrbm = "UPDATE bieumau SET TenBM='$_TenBM', SoLuong='$_SoLuong' WHERE MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
				else
				{
					if($maBieuMau > 0) // xóa bỏ biểu mẫu này và cập nhật lại văn bản đến
					{
						$qrbm = "DELETE from bieumau Where MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='0' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhận lại văn bản đến
					{
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
			}
		}
		else // có tài liệu đính kèm
		{
			//Tìm và xóa file trong thu mục
			$dir="upload/vanbanden/";
			$file=$row_VBD['TaiLieuDinhKem'];
			if(file_exists($dir.$file)){
					 unlink($dir.$file);
			}
			// upload tài liệu lên server
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
			 if($_CVDTheoDuong == 2) // nhân văn trực tiếp đem văn bản đến
			{
				if($_MaBM == 1)
				{
					if($maBieuMau==0) // thêm mới biểu mẫu nhưng cập nhật lại văn bản đến
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1'  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='$MaBM_cuoi' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhật lại biểu mẫu và văn bản đến
					{
						$qrbm = "UPDATE bieumau SET TenBM='$_TenBM', SoLuong='$_SoLuong' WHERE MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
				else
				{
					if($maBieuMau > 0) // xóa bỏ biểu mẫu này và cập nhật lại văn bản đến
					{
						$qrbm = "DELETE from bieumau Where MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='0' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhận lại văn bản đến
					{
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong', TenNVDen='$_TenNVDen',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
			}
			else // theo đường khác
			{
				if($_MaBM == 1)
				{
					if($maBieuMau==0) // thêm mới biểu mẫu nhưng cập nhật lại văn bản đến
					{
						$qrbm = "INSERT INTO bieumau VALUES (null,'$_TenBM','$_SoLuong')";
						mysql_query($qrbm);
						$row_bieumau = QLVB_BieuMau_LayBieuMauCuoiCung();
						$MaBM_cuoi = $row_bieumau['MaBM'];
						settype($MaBM_cuoi,"int");
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='$MaBM_cuoi' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhật lại biểu mẫu và văn bản đến
					{
						$qrbm = "UPDATE bieumau SET TenBM='$_TenBM', SoLuong='$_SoLuong' WHERE MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
				else
				{
					if($maBieuMau > 0) // xóa bỏ biểu mẫu này và cập nhật lại văn bản đến
					{
						$qrbm = "DELETE from bieumau Where MaBM = '$maBieuMau'";
						mysql_query($qrbm);
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong', TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet', MaBM='0' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
					else // cập nhận lại văn bản đến
					{
						$qrvbd = "
								UPDATE vanbanden SET TenVB='$_TenVB', SoHieu='$_SoHieu', KyHieu='$_KyHieu', NgayKy='$_NgayKy', NgayDen='$_NgayDen', MaLVB='$_MaLVB', MaCQ='$_MaCQ', MucDoKhan='$_MucDoKhan', MucDoMat='$_MucDoMat',  MaNSD='$_MaNV', NoiDung='$_NoiDung', TaiLieuDinhKem='$_Tailieudinhkem1',  CVDTheoDuong='$_CVDTheoDuong',  TinhTrangXuLy='$_TinhTrangXuLy', HanXuLy='$_HanXuLy', NoiDungXuLy='$_NoiDungXuLy', PhongBanXuLy='$_PhongBanXuLy', DuyetLanhDao='$_LanhDaoDuyet', NoiDungDuyet='$_NoiDungDuyet' WHERE MaVB = '$MaVB'
						";
						mysql_query($qrvbd);
						header ("location:index.php?active=vanbanden&pages=van-ban-den");
					}
				}
			}			
		}
	}
  ?>
<div class="page_div" style="width:877px;margin-bottom:20px; margin-left:4%; margin-top:40px;" id="frmThemvanbanden">
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">THÊM VĂN BẢN ĐẾN</div></center>
<form action="" method="post" enctype="multipart/form-data" name="frmSuavanbanden" onSubmit="return check()">
 <div style="float:left; width:430px; margin-right:10px;">
  <fieldset >
  <legend>Thông tin văn bản đến</legend>
  <table width="400" border="0">
  <tr>
  <td align="right" valign="top">Tên văn bản:
  </td>
  <td><label for="txtTenVB2"></label>
    <input class="text" name="txtTenVB" type="text" id="txtTenVB2" size="25" value='<?php echo $row_VBD["TenVB"]; ?>'></td>
  </tr>
  <tr>
    <td align="right" valign="top">Số hiệu:</td>
    <td><label for="txtSohieu"></label>
      <input  name="txtSohieu" type="text" id="txtSohieu" size="3" value='<?php echo $row_VBD["SoHieu"]; ?>'> <label for="txtKyhieu"> &nbsp;Ký hiệu: </label>
      <input  name="txtKyhieu" type="text" id="txtKyhieu" size="7" value='<?php echo $row_VBD["KyHieu"]; ?>'>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Ngày ký:</td>
    <td><label for="txtNgayky"></label>
      <input name="txtNgayky" type="text" id="txtNgayky" size="25" readonly="readonly" value='<?php echo $row_VBD["NgayKy"]; ?>'>
      <div class="msg2" id='z-ngayky'></div>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Ngày đến:</td>
    <td><label for="txtNgayden"></label>
      <input name="txtNgayden" type="text" id="txtNgayden" size="25" readonly="readonly" value='<?php echo $row_VBD["NgayDen"]; ?>'>
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
        <option <?php if($row_VBD['MaLVB']==$row_loaivanban['MaLVB']){ echo "selected=selected"; } ?> value="<?php echo $row_loaivanban['MaLVB'] ?>"><?php echo $row_loaivanban['TenLVB'] ?></option>
        <?php 
				}
		?>
      </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">Cơ quan đến:</td>
    <td><label for="listMucdomat"></label>
      <select name="listCoquan" id="listCoquan">
      <?php
				$_Coquan = QLVB_CoQuan_LayTatCa();
				while ($row_coquan = mysql_fetch_array($_Coquan)){
  			?>
        <option <?php if($row_VBD['MaCQ']==$row_coquan['MaCQ']){ echo "selected=selected"; } ?> value="<?php echo $row_coquan['MaCQ'] ?>"><?php echo $row_coquan['TenCQ'] ?></option>
        <?php 
				}
		?>
      </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">Mức độ khẩn:</td>
    <td>
      <select name="listMucdokhan" id="listMucdokhan">
        <option <?php if($row_VBD['MucDoKhan']==1) echo "selected=selected"; ?> value="1">Bình thường</option>
        <option <?php if($row_VBD['MucDoKhan']==2) echo "selected=selected"; ?> value="2">Khẩn</option>
        <option <?php if($row_VBD['MucDoKhan']==3) echo "selected=selected"; ?> value="3">Hỏa tốc</option>
      </select> 
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Mức độ mật:</td>
    <td>
      <label for="listMucdomat"></label>
      <select name="listMucdomat" id="listMucdomat">
        <option <?php if($row_VBD['MucDoMat']==1) echo "selected=selected"; ?> value="1">Bình thường</option>
        <option <?php if($row_VBD['MucDoMat']==2) echo "selected=selected"; ?> value="2">Mật</option>
        <option <?php if($row_VBD['MucDoMat']==3) echo "selected=selected"; ?> value="3">Tuyệt Mật</option>
      </select>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Nội dung:</td>
    <td><label for="txtNoidung"></label>
      <textarea name="txtNoidung" id="txtNoidung" cols="35" rows="5"><?php echo $row_VBD["NoiDung"]; ?></textarea>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Tài liệu:</td>
    <td><label for="fileTailieu"></label>
      <input type="file" name="fileTailieu" id="fileTailieu" ></td>
  </tr>
  <tr>
    <td align="right" valign="top">Theo đường:</td>
    <td><div style="float:left; width:90px">
      <label>
        <input <?php if($row_VBD['CVDTheoDuong']==1) echo "checked=checked"; ?> type="radio" name="dgTheoduong" value="1" id="dgTheoduong_0">
        Bưu điện</label>
      </div>
      <div style="float:left; width:100px">
      <label>
        <input <?php if($row_VBD['CVDTheoDuong']==2) echo "checked=checked"; ?> type="radio" name="dgTheoduong" value="2" id="dgTheoduong_1">
        Nhân viên</label>
      </div>
      <div style="float:left; width:70px">
      <label>
        <input name="dgTheoduong" type="radio" id="dgTheoduong_2" value="3" <?php if($row_VBD['CVDTheoDuong']==3) echo "checked=checked"; ?> >
        Khác</label></div>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top">Nhân viên:</td>
    <td><label for="txtNhanvien"></label>
      <input name="txtNhanvien" type="text" id="txtNhanvien" size="25" value="<?php echo $row_VBD['TenNVDen'] ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Biểu mẫu:</td>
    <td> <div style="float:left; width:50px">
        <input <?php if($row_VBD['MaBM'] > 0) echo "checked=checked"; ?> type="radio" name="dgBieuMau" value="1" id="dgBieuMau_0" > có
        </div>
     	<div style="float:left; width:100px">     
        <input <?php if($row_VBD['MaBM'] == 0) echo "checked=checked"; ?> name="dgBieuMau" type="radio" id="dgBieuMau_1" value="0" > Không
        </div>
       </td>
  </tr>
  <tr>
    <td align="right" valign="top">Tên BM:</td>
    <td><label for="txtTenBM"></label>
      <input value="<?php echo $row_BM['TenBM'] ; ?>" name="txtTenBM" type="text" id="txtTenBM" size="25"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Số lượng:</td>
    <td><label for="txtSoluong"></label>
      <input value="<?php echo $row_BM['SoLuong'] ; ?>" name="txtSoluong" type="text" id="txtSoluong" size="25"></td>
  </tr>
  </table>
  </fieldset>
  </div>
  <div style="float:left; width:430px">
  <fieldset>
  <legend>Xử lý văn bản &amp; duyệt lãnh đạo</legend>
  <table width="400" border="0">
  <tr>
  <td align="right" valign="top">Tình trạng:
  </td>
  <td><div style="float:left; width:100px">
    <label>
      <input <?php if($row_VBD['TinhTrangXuLy'] == 1) echo "checked=checked"; ?> type="radio" name="dgTinhtrangxuly" value="1" id="RadioGroup1_0">
      Đã xử lý</label>
    </div>
    <div style="float:left; width:120px">
    <label>
      <input <?php if($row_VBD['TinhTrangXuLy'] == 0) echo "checked=checked"; ?>  name="dgTinhtrangxuly" type="radio" id="RadioGroup1_1" value="0" >
      Chưa xử lý</label></div>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top">Hạn xử lý:</td>
    <td><label for="txtHanxuly"></label>
      <input value="<?php echo $row_VBD['HanXuLy']; ?>" name="txtHanxuly" type="text" id="txtHanxuly" size="25" readonly="readonly"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Nội dung:</td>
    <td><label for="txtNoidungxuly"></label>
      <textarea name="txtNoidungxuly" id="txtNoidungxuly" cols="35" rows="5"><?php echo $row_VBD['NoiDungXuLy']; ?></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">Khoa phòng:</td>
    <td><label for="txtKhoaphongxuly"></label>
      <textarea name="txtKhoaphongxuly" id="txtKhoaphongxuly" cols="35" rows="5"><?php echo $row_VBD['PhongBanXuLy']; ?></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">Lãnh đạo duyệt:</td>
    <td><label for="txtLanhdaoduyet"></label>
      <select name="txtLanhdaoduyet" id="txtLanhdaoduyet">
      <?php
				$_nguoidung = QLVB_NguoiDung_LayTatCaDuyetLanhDao();
				while ($row_nguoidung = mysql_fetch_array($_nguoidung)){
  			?>
        <option <?php if($row_VBD['DuyetLanhDao']==$row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']) echo "selected=selected";?> value="<?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?>"><?php echo $row_nguoidung['HoTenDem'].' '. $row_nguoidung['Ten']; ?></option>
        <?php 
				}
		?>
      </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">Nội dung duyệt:</td>
    <td><label for="txtNoidungduyet"></label>
      <textarea name="txtNoidungduyet" id="txtNoidungduyet" cols="35" rows="5"><?php echo $row_VBD['NoiDungDuyet'] ?></textarea></td>
  </tr>
  </table>
  </fieldset>
  <fieldset style="margin-top:10px">
  <legend></legend>
  <center><input  type="submit" name="btnLuu" value="Lưu" class="redbtvl"/></center>
  </fieldset>
  </div>
  <div class="page_danhmuc_clear"></div>
</form>
</div>
 <div class="page_danhmuc_clear"></div>
<script type="text/javascript" language="javascript">
function check()
{
	 _Tenvb=document.frmThemvanbanden.txtTenVB2;
	 _Sohieu=document.frmThemvanbanden.txtSohieu;
	 _Kyhieu=document.frmThemvanbanden.txtKyhieu;
	 _Ngayky=document.frmThemvanbanden.txtNgayky;
	 _Ngayden=document.frmThemvanbanden.txtNgayden;
	 _Noidung=document.frmThemvanbanden.txtNoidung;
	 _Cobieumau = document.frmThemvanbanden.dgBieuMau_0;
	 _Tenbieumau = document.frmThemvanbanden.txtTenBM;
	 _SLbieumau = document.frmThemvanbanden.txtSoluong;
	 _vbdTheoduong = document.frmThemvanbanden.dgTheoduong_1;
	 _TheoduongNhanvien = document.frmThemvanbanden.txtNhanvien;
	 if(_Tenvb.value == "")
	 {
		 alert("Tên văn bản đến không được rỗng.");
		 _TenVB.focus();
		 return false;
	 }
	 else if(_Sohieu.value == "")
	 {
		 alert("Số hiệu không được rỗng.");
		 _Sohieu.focus();
		 return false;
	 }
	 else if(isNaN(_Sohieu.value) == true)
	 {
		 alert("Số hiệu phải là số.");
		 _Sohieu.focus();
		 return false;
	 }
	 else if(_Kyhieu.value == "")
	 {
		 alert("Ký hiệu không được rỗng.");
		 _Kyhieu.focus();
		 return false;
	 }
	 else if(_Ngayky.value == "")
	 {
		 alert("Ngày ký không được rỗng.");
		 _Ngayky.focus();
		 return false;
	 }
	 else if(_Ngayden.value == "")
	 {
		 alert("Ngày đến không được rỗng.");
		 _Ngayden.focus();
		 return false;
	 }
	 else if(_Noidung.value == "")
	 {
		 alert("Nội dung không được rỗng.");
		 _Noidung.focus();
		 return false;
	 }
	 else if(_vbdTheoduong.checked == true)
	 {
		 if(_TheoduongNhanvien.value == "")
		 {
			 alert("Tên nhân viên không được rỗng.");
			 _TheoduongNhanvien.focus();
			 return false;
		 }
	 }
	 else if(_Cobieumau.checked == true)
	 {
		 if(_Tenbieumau.value == "")
		 {
			 alert("Tên biểu mẫu không được rỗng.");
			 _Tenbieumau.focus();
			 return false;
		 }
		 else if(_SLbieumau.value=="")
		 {
			 alert("Số lượng biểu mẫu không được rỗng.");
			 _SLbieumau.focus();
			 return false;
		 }
		 else if(isNaN(_SLbieumau.value) == true)
		 {
			 alert("Số lượng biểu mẫu phải là số.");
			 _SLbieumau.focus();
			 return false;
		 }
		 else if(_SLbieumau.value <= 0)
		 {
			 alert("Số lượng biểu mẫu phải lớn hơn 0.");
			 _SLbieumau.focus();
			 return false;
		 }
	 }
	 else
	 	return true;
}
</script>