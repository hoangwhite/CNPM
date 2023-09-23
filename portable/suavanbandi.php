<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaVB = $_GET["id"];
	settype($MaVB,"int");
	$row_vbdi = QLVB_VanBanDi_LayTheoMa($MaVB);
	$MaBM_VBDI = $row_vbdi["MaBM"];
	settype($MaBM_VBDI,"int");
	$row_bm = QLVB_BieuMau_LayTheoMa($MaBM_VBDI);

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
		if($_tenVB == NULL || $_SoHieu == NULL || $_KyHieu == NULL || $_NgayKy == NULL || $_NoiDung == NULL){
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
			if($ten_CQ == "")//Nếu không chọn tên cơ quan gởi đi thì lấy tên củ đã có trong CSDL
			{				
				if($_TaiLieuDinhKem==NULL)// nếu không có tài liệu đính kèm thì lấy tài liệu củ đã đc lưu trong CSDL
				{
					if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong==3)// nếu chọn cách thức gởi vb đi theo đường bưu điện hoặc đường khác thì thực hiện
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và không tài liệu đính kèm và công văn được gởi đi theo đường bưu điện, khác và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/*Thực hiện công việc là không cập nhật lại cơ quan gởi đi và tài liệu đính kèm và công văn được gởi đi theo đường bưu điện, khác và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
					else // văn bản đi được đích thân nhân viên nào đó đem đến cơ quan cần gởi
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên đích thân đem đến) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
							
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên đích thân đem đến) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
				}
				else// cập nhật lại tài liệu đính kèm và xóa tài liệu củ đi
				{
					//Tìm và xóa file trong thu mục
					$dir="upload/vanbandi/";
					$file=$row_vbdi['TaiLieuDinhKem'];
					if(file_exists($dir.$file)){
							 unlink($dir.$file);
					}
					// upload tài liệu lên server
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
					if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong==3)// nếu chọn cách thức gởi vb đi theo đường bưu điện hoặc đường khác thì thực hiện
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và cập nhật lại tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện và đường khác) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1' , CVDiTheoDuong = '$_CVDiTheoDuong', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
							
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và cập nhật lại tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện và đường khác) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1' , CVDiTheoDuong = '$_CVDiTheoDuong', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
					else // văn bản đi được đích thân nhân viên nào đó đem đến cơ quan cần gởi
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và cập nhật lại tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1' , CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi' , LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là không cập nhật lại cơ quan gởi đi và cập nhật lại tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1' , CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi' , LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
				}
			}
			else// cập nhật lại tên cơ quan gởi đi đã được chọn
			{
				if($_TaiLieuDinhKem==NULL)// nếu không có tài liệu đính kèm thì lấy tài liệu củ đã đc lưu trong CSDL
				{
					if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong==3)// nếu chọn cách thức gởi vb đi theo đường bưu điện hoặc đường khác thì thực hiện
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và không có tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện hoặc đường khác) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và không có tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện hoặc đường khác) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
					else // văn bản đi được đích thân nhân viên nào đó đem đến cơ quan cần gởi
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và không có tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và không có tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
				}
				else// cập nhật lại tài liệu đính kèm và xóa tài liệu củ đi
				{
					//Tìm và xóa file trong thu mục
					$dir="upload/vanbandi/";
					$file=$row_vbdi['TaiLieuDinhKem'];
					if(file_exists($dir.$file)){
							 unlink($dir.$file);
					}
					// upload tài liệu lên server
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
					if($_CVDiTheoDuong == 1 || $_CVDiTheoDuong==3)// nếu chọn cách thức gởi vb đi theo đường bưu điện hoặc đường khác thì thực hiện
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và có tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện hoặc đường khác) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1', CVDiTheoDuong = '$_CVDiTheoDuong', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và có tài liệu đính kèm và văn bản được gởi đi theo đường (bưu điện hoặc đường khác) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1', CVDiTheoDuong = '$_CVDiTheoDuong', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
					else // văn bản đi được đích thân nhân viên nào đó đem đến cơ quan cần gởi
					{
						if($_MaBM==0)// chọn điều kiện không có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và có tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và không có mã biểu mẫu */
							$qr = "
							UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
							";
							mysql_query($qr);
							header("location:?active=vanbandi&pages=van-ban-di");
						}
						else // chọn điều kiện có biểu mẫu
						{
							/* Thực hiện công việc là cập nhật lại cơ quan gởi đi và có tài liệu đính kèm và văn bản được gởi đi theo đường (nhân viên) và có mã biểu mẫu */
							if($_TenBM == NULL || $_SoLuong == NULL){
								echo "<div class='msg1'> Tên biểu mẫu, số lượng không được rỗng. </div>";
							}
							else if(!ereg('^[0-9]+$',$_SoLuong)){
								echo "<div class='msg1'> Số lượng phải là số. </div>";
							}
							else
							{
								$qr1 = "
								UPDATE bieumau SET TenBM = '$_TenBM', SoLuong = '$_SoLuong' WHERE MaBM = '$MaBM_VBDI'
								";
								mysql_query($qr1);
								$qr = "
								UPDATE vanbandi SET TenVB = '$_tenVB', SoHieu = '$_SoHieu', KyHieu= '$_KyHieu', NgayKy = '$_NgayKy', NgayGoi = '$_ngaygio', MaLVB = '$_MaLVB', MucDoKhan = '$_MucDoKhan', MucDoMat = '$_MucDoMat', MaNSD = '$MaNSD', NoiDung = '$_NoiDung', TailieuDinhKem = '$_Tailieudinhkem1', CVDiTheoDuong = '$_CVDiTheoDuong', TenNV = '$_TenNVDi', CQNhan = '$ten_CQ', LanhDaoDuyet = '$_DuyetLanhDao', NoiDungDuyet = '$_NoiDungDuyet' WHERE MaVB = '$MaVB'
								";
								mysql_query($qr);
								header("location:?active=vanbandi&pages=van-ban-di");
							}
						}
					}
				}
			}
		}			
	}
?>

 <div class="page_div" style="width:600;margin-bottom:20px; margin-left:20%; margin-top:40px;" >
<center>
  <div class="mndanhmuc" style="margin-bottom:20px">CẬP NHẬT VĂN BẢN ĐI</div></center>
<form action="" method="post" enctype="multipart/form-data" name="frmThamvanbandi">
  <table border="0" width="600">
    <tr>
  	<td width="110" align="right" valign="top"><span class="lb">Tên văn bản:</span></td>
    <td colspan="3"><input name="txtTenVB" type="text" id="txtTenVB" value="<?php echo $row_vbdi["TenVB"]; ?>" size="44"></td>
    </tr>
  <tr>
    <td align="right" valign="top"><span class="lb">Số hiệu:</span></td>
    <td width="97"><span class="lb1">
      <input name="txtSohieu" type="text" id="txtSohieu" value="<?php echo $row_vbdi["SoHieu"]; ?>" size="10">
    </span></td>
    <td width="85" align="right" valign="top"><span class="lb">Ký hiệu:</span></td>
    <td width="290"><span class="lb1">
      <input name="txtKyhieu" type="text" id="txtKyhieu" value="<?php echo $row_vbdi["KyHieu"]; ?>" size="10">
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><span class="lb">Ngày ký:</span></td>
    <td><span class="lb1">
      <input name="txtNgayky" type="text" id="txtNgayky" value="<?php echo $row_vbdi["NgayKy"]; ?>" size="10" readonly="readonly">
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
        <option <?php if($row_vbdi['MucDoKhan']==1) echo "selected"; ?> value="1">Bình thường</option>
        <option <?php if($row_vbdi['MucDoKhan']==2) echo "selected"; ?> value="2">Khẩn</option>
        <option <?php if($row_vbdi['MucDoKhan']==3) echo "selected"; ?> value="3">Hỏa tốc</option>
      </select>
    </span></td>
    <td align="right" valign="top"><span class="lb">Mức độ mật:</span></td>
    <td><span class="lb1">
      <select name="listMat" id="listMat">
        <option <?php if($row_vbdi['MucDoMat']==1) echo "selected"; ?> value="1">Bình thường</option>
        <option <?php if($row_vbdi['MucDoMat']==2) echo "selected"; ?> value="2">Mật</option>
        <option <?php if($row_vbdi['MucDoMat']==3) echo "selected"; ?> value="3">Tuyệt mật</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top">Trích dẫn:</td>
    <td colspan="3"><textarea name="txtTrichdan" id="txtTrichdan" cols="45" rows="5"><?php echo $row_vbdi['NoiDung'] ?>
    </textarea></td>
    </tr>
  <tr>
    <td align="right" valign="top">Tài liệu đính kèm:</td>
    <td colspan="3"><label for="flTailieu"></label>
      <input type="file" name="flTailieu" id="flTailieu"></td>
    </tr>
  <tr>
    <td align="right" valign="top">Theo đường:</td>
    <td colspan="3"><div class="divrd">
      <input <?php if($row_vbdi['CVDiTheoDuong']==1) echo "checked=checked"; ?> type="radio" name="rgTheoduong" value="1" id="rgTheoduong_0">
      Bưu điện</div>
      <div class="divrd">
        <input <?php if($row_vbdi['CVDiTheoDuong']==2) echo "checked=checked"; ?> type="radio" name="rgTheoduong" value="2" id="rgTheoduong_1">
        Nhân viên</div>
      <div class="divrd">
        <input <?php if($row_vbdi['CVDiTheoDuong']==3) echo "checked=checked"; ?> type="radio" name="rgTheoduong" value="3" id="rgTheoduong_2">
        Khác</div></td>
    </tr>
  <tr>
    <td align="right" valign="top">Tên nhân viên:</td>
    <td colspan="3"><input name="txtNhanvien" type="text" id="txtNhanvien" value="<?php echo $row_vbdi["TenNV"]; ?>" size="25"></td>
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
    <td colspan="3"><textarea name="txtNoidung" id="txtNoidung" cols="45" rows="5"><?php echo $row_vbdi["NoiDungDuyet"]; ?></textarea></td>
    </tr>
  <tr>
    <td align="right" valign="top">Biểu mẫu:</td>
    <td colspan="3"><div class="divrd">
      <input <?php if($row_vbdi['MaBM']>0) echo "checked=checked"; ?> type="radio" name="rgBieumau" value="1" id="rgBieumau_0">
      Có</div>
      <div class="divrd">
        <input <?php if($row_vbdi['MaBM']==0) echo "checked=checked"; ?> type="radio" name="rgBieumau" value="0" id="rgBieumau_1" >
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
