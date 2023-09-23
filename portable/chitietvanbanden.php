<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaVB = $_GET["id"];
	settype($MaVB,"int");
	$row_vbd = QLVB_VanBanDen_LayTheoMa($MaVB);
	$MaBM_VBD = $row_vbd["MaBM"];
	settype($MaBM_VBD,"int");
	$row_bm = QLVB_BieuMau_LayTheoMa($MaBM_VBD);
?>

<div class="page_div" style="width:955px;margin-bottom:20px;">
	<center><div class="mndanhmuc">CHI TIẾT VĂN BẢN ĐẾN</div></center>
    <div><strong>Tên văn bản:</strong> <?php echo $row_vbd['TenVB']; ?></div>
    <div><strong>Số:</strong> <?php echo $row_vbd['SoHieu'].'/'.$row_vbd['KyHieu']; ?></div>
    <div><strong>Ngày ký:</strong> <?php echo $row_vbd['NgayKy']; ?></div>
  	<div><strong>Ngày đến: </strong> <?php echo $row_vbd['NgayDen']; ?></div>
  	<div><strong>Loại văn bản:</strong> <?php echo $row_vbd['MaLVB']; ?></div>
  	<div><strong>Cơ quan đến:</strong> <?php echo $row_vbd['MaCQ']; ?></div>
  	<div><strong>Mức độ khẩn:</strong> <?php $khan = $row_vbd['MucDoKhan'];
	if($khan == 1){
		echo "Bình thường";
	}
	else if($khan == 2){
		echo "Khẩn";
	}
	else echo "Hỏa tốc";
	  ?></div>
 	<div><strong>Mức độ mật:</strong> <?php $mat = $row_vbd['MucDoMat'];
	if($mat == 1){
		echo "Bình thường";
	}
	else if($mat == 2){
		echo "Mật";
	}
	else echo "Tuyệt mật"; ?></div>
    <div><strong>Trích dẫn:</strong> <?php echo $row_vbd['NoiDung']; ?></div>
    <div><strong>Tài liệu đính kèm:</strong> 
    <?php
      		$tailieu = $row_vbd['TaiLieuDinhKem'];
			if($tailieu != NULL)
			{
				echo $tailieu." ";
				echo "<a href='./portable/taivanbanden.php?files=".$tailieu."'><img src='css/img/download.png' alt='Download' width='15' height='15' /> Tải xuống</a>";
			}
			else echo 'Không';
	  ?></div>
    <div><strong>Văn bản đến theo đường:</strong>  
    <?php 
		$theoduong = $row_vbd['CVDTheoDuong'];
		if($theoduong == 1){
			echo "Bưu điện";
		}
		else if($theoduong == 3){
			echo "Khác";
		}
		else
		{
			echo $row_vbd['TenNVDen'].' đem đến';
		}
	?>
    </div>
    <div><strong>Tình trạng xử lý:</strong>
    	<?php
			$tinhtrangxuly = $row_vbd['TinhTrangXuLy']; 
			if($tinhtrangxuly == 1){
				echo " Đã xử lý";
			}
			else echo " Chưa xủ lý";
		 ?>
    </div>
    <div><strong>Hạn xử lý:</strong> <?php echo $row_vbd['HanXuLy']; ?> </div>
    <div><strong>Nội dung xử lý:</strong> <?php echo $row_vbd['NoiDungXuLy']; ?> </div>
    <div><strong>Khoa phòng xử lý:</strong>  <?php echo $row_vbd['PhongBanXuLy']; ?></div>
    <div><strong>Lãnh đạo duyệt:</strong> <?php echo $row_vbd['DuyetLanhDao']; ?></div>
    <div><strong>Nội dung duyệt:</strong> <?php echo $row_vbd['NoiDungDuyet']; ?> </div>
    <div><strong>Biểu mẫu:</strong> 
	<?php 
		$bm = $row_vbd['MaBM'];
		if($bm == 0){
			echo "Không";
		}
		else
		{
			echo "Có";
			echo "<div><strong>Tên biểu mẫu:</strong> ".$row_bm['TenBM']."</div>";
			echo "<div><strong>Số lượng:</strong> ".$row_bm['SoLuong']."</div>";
		}
	 ?></div>
</div>