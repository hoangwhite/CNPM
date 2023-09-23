<?php 
	require "../lib/dbcon.php";
	require "../lib/trangchu.php";
	$MaCQSuDung = QLVB_CoQuan_CQSuDung();
	$MaCQSD = $MaCQSuDung["MaCQ"];
	$db_number = 0;
	$phongban = QLVB_PhongBan_LayTheoMaCQ($MaCQSD);
		while($row_phongban = mysql_fetch_array($phongban)){
	?>
    <input type="checkbox" name="ck_<?=$db_number?>" value="<?php echo $row_phongban['TenPhong'] ?>"  /> 
  	<?php echo $row_phongban['TenPhong']; ?><br />
	<?php
			$db_number++;
		}
    ?>