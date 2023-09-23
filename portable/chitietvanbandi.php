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

<div class="page_div" style="width:955px;margin-bottom:20px;">
	<center><div class="mndanhmuc">CHI TIẾT VĂN BẢN ĐI</div></center>
    <div><strong>Tên văn bản:</strong><?php echo $row_vbdi['TenVB']; ?></div>
    <div><strong>Số:</strong> <?php echo $row_vbdi['SoHieu'].'/'.$row_vbdi['KyHieu']; ?></div>
    <div><strong>Ngày ký:</strong> <?php echo $row_vbdi['NgayKy']; ?></div>
  	<div><strong>Ngày đến: </strong> <?php echo $row_vbdi['NgayGoi']; ?></div>
  	<div><strong>Loại văn bản:</strong> <?php echo $row_vbdi['TenLVB']; ?></div>
  	<div><strong>Cơ quan nhận:</strong> <?php echo $row_vbdi['CQNhan']; ?></div>
  	<div><strong>Mức độ khẩn:</strong> <?php $khan = $row_vbdi['MucDoKhan'];
	if($khan == 1){
		echo "Bình thường";
	}
	else if($khan == 2){
		echo "Khẩn";
	}
	else echo "Hỏa tốc";
	  ?></div>
 	<div><strong>Mức độ mật:</strong> <?php $mat = $row_vbdi['MucDoMat'];
	if($mat == 1){
		echo "Bình thường";
	}
	else if($mat == 2){
		echo "Mật";
	}
	else echo "Tuyệt mật"; ?></div>
    <div><strong>Trích dẫn:</strong> <?php echo $row_vbdi['NoiDung']; ?></div>
    <div><strong>Tài liệu đính kèm:</strong> 
    <?php
      		$tailieu = $row_vbdi['TailieuDinhKem'];
			if($tailieu != NULL)
			{
				echo $tailieu." ";
				echo "<a href='./portable/taivanbandi.php?files=".$tailieu."'><img src='css/img/download.png' alt='Download' width='15' height='15' /> Tải xuống</a>";
			}
			else echo 'Không';
	  ?></div>
    <div><strong>Văn bản đến theo đường:</strong>  
    <?php 
		$theoduong = $row_vbdi['CVDiTheoDuong'];
		if($theoduong == 1){
			echo "Bưu điện";
		}
		else if($theoduong == 3){
			echo "Khác";
		}
		else
		{
			echo $row_vbdi['TenNV'].' đem đến';
		}
	?>
    </div>
    <div><strong>Lãnh đạo duyệt:</strong> <?php echo $row_vbdi['LanhDaoDuyet']; ?></div>
    <div><strong>Nội dung duyệt:</strong> <?php echo $row_vbdi['NoiDungDuyet']; ?> </div>
    <div><strong>Biểu mẫu:</strong> 
	<?php 
		$bm = $row_vbdi['MaBM'];
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