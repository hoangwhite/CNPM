<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hệ thông quản lý văn bản</title>
<link rel="stylesheet" type="text/css" href="../css/print.css"/>
<link rel="stylesheet" type="text/css" href="../css/table.css"/>
</head>

<body class="A4_L" onload="window.print()">
	<h3><center>DANH SÁCH VĂN BẢN NỘI BỘ<br />THEO LOẠI VĂN BẢN</center></h3>
<table width="1130">
  <tr align="center"  style="font-weight:bold; background-color:#FCF; color:#000">
    <td width="80">Số</td>
    <td width="100">Ngày ký</td>
    <td width="350">Tên</td>
    <td width="450">Nội dung trích dẫn</td>
    <td width="50">SLBM</td>
    <td width="150">Lãnh đạo duyệt</td>
  </tr>
  <?php
  		require "../lib/dbcon.php";
  		require "../lib/trangchu.php";
  		$_LVB = $_GET["lvb"];	
		$ds = QLVB_VanBanNoiBo_DanhSachVBNBTheoLVB($_LVB);
	 	$tong = 0;
		 while($row = mysql_fetch_array($ds))
		 {
			 ob_start();
			 $tong = $tong + $row["SLBM"];
  ?>
  <tr>
    <td align="center" valign="middle">{Sohieu}/{KyHieu}</td>
    <td align="center" valign="middle">{NgayKy}</td>
    <td>{TenVB}</td>
    <td>{NoiDung}</td>
    <td align="center" valign="middle">{SLBM}</td>
    <td valign="middle">{LanhDaoDuyet}</td>
  </tr>
  <?php 
		$s= ob_get_clean();
		$s = str_replace("{Sohieu}",$row["SoHieu"],$s);
		$s = str_replace("{KyHieu}",$row["KyHieu"],$s);
		$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
		$s = str_replace("{TenVB}",$row["TenVB"],$s);
		$s = str_replace("{NoiDung}",substr($row["NoiDung"],0,200),$s);
		$s = str_replace("{SLBM}",$row["SLBM"],$s);
		$s = str_replace("{LanhDaoDuyet}",$row["LanhDaoDuyet"],$s);
		echo $s;
	 } 
  ?>
  <tr>
    <td colspan="4" align="right" valign="middle"><b>Tổng số biểu mẫu:</b></td>
    <td align="center" valign="middle"><?php echo $tong; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>