<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
	$MaVB = $_GET["id"];
	settype($MaVB,"int");
	$row_vbnb = QLVB_VanBanNoiBo_LayTheoMa($MaVB);
	$MaBM_VBNB = $row_vbnb["MaBM"];
	settype($MaBM_VBNB,"int");
	$row_bm = QLVB_BieuMau_LayTheoMa($MaBM_VBNB);
?>

<div class="page_ThemND" style="width: 940px; margin-bottom: 20px; margin-left: 20px; background-image: url(css/img/background.png);">
<center><div class="mndanhmuc" style="margin-bottom:20px">CHI TIẾT VĂN BẢN NỘI BỘ</div></center>
<?php
	if($MaBM_VBNB == 0)
	{
?>
  <table width="920" border="0">
   <tr>
      <td width="151" align="right" valign="top"><b>Tên văn bản:</b></td>
      <td width="759" align="left" valign="top"> <?php echo $row_vbnb["TenVB"];?></td>
    </tr>
    <tr>
      <td width="151" align="right" valign="top"><b>Số hiệu:</b></td>
      <td width="759" align="left" valign="top"> <?php echo "Số ".$row_vbnb["SoHieu"]."/".$row_vbnb["KyHieu"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Ngày ký:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["NgayKy"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Ngày lưu:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["NgayLuu"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Loại văn bản:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["MaLVB"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Nội dung:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["NoiDung"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Tài liệu đính kèm:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["TailieuDinhKem"];?>
      <?php
      		$tailai = $row_vbnb["TailieuDinhKem"];
			if($tailai != NULL)
			{
				echo "<a href='./portable/taivanbannoibo.php?files=".$tailai."'><img src='css/img/download.png' alt='Download' width='15' height='15' /> Tải xuống</a>";
			}
	  ?>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Khoa phòng nhận:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["PBNhan"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Tên lãnh đạo duyệt:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["LanhDaoDuyet"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Nội dung duyệt:</b></td>
      <td align="left" valign="top"> <?php echo $row_vbnb["NoiDungDuyet"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Biểu mẫu:</b></td>
      <td align="left" valign="top"><?php if($row_vbnb["MaBM"]==0){echo "Không";}else {echo "Có";} ?></td>
    </tr>
  </table>
<?php
	}
	else
	{
?>
<table width="920" border="0">
   <tr>
      <td width="150" align="right" valign="top"><b>Tên văn bản:</b></td>
      <td width="760" align="left" valign="top"> <?php echo $row_vbnb["TenVB"];?></td>
    </tr>
    <tr>
      <td width="150" align="right" valign="top"><b>Số hiệu:</b></td>
      <td width="760" align="left" valign="top"><?php echo "Số ".$row_vbnb["SoHieu"]."/".$row_vbnb["KyHieu"]; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Ngày ký:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["NgayKy"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Ngày lưu:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["NgayLuu"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Loại văn bản:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["MaLVB"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Nội dung:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["NoiDung"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Tài liệu đính kèm:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["TailieuDinhKem"];?>
      <?php
      		$tailai = $row_vbnb["TailieuDinhKem"];
			if($tailai != NULL)
			{
				echo "<a href='./portable/taivanbannoibo.php?files=".$tailai."'><img src='css/img/download.png' alt='Download' width='15' height='15' /> Tải xuống</a>";
			}
	  ?>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Khoa phòng nhận:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["PBNhan"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Tên lãnh đạo duyệt:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["LanhDaoDuyet"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Nội dung duyệt:</b></td>
      <td align="left" valign="top"><?php echo $row_vbnb["NoiDungDuyet"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Biểu mẫu:</b></td>
      <td align="left" valign="top"><?php if($row_vbnb["MaBM"]==0){echo "Không";}else {echo "Có";} ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Tên biểu mẫu:</b></td>
      <td align="left" valign="top"><?php echo $row_bm["TenBM"];?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>Số lượng:</b></td>
      <td align="left" valign="top"><?php echo $row_bm["SoLuong"];?></td>
    </tr>
  </table>
  <?php
	}
  ?>
</div>