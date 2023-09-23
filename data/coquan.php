<?php 
	require "../lib/dbcon.php";
	require "../lib/trangchu.php";
	$db_number = 0;
	$cq = QLVB_CoQuan_LayTatCa();
		while($row_phongban = mysql_fetch_array($cq)){
	?>
    <input type="checkbox" name="ck_<?=$db_number?>" value="<?php echo $row_phongban['TenCQ'] ?>" /> 
  	<?php echo $row_phongban['TenCQ']; ?><br />
	<?php
			$db_number++;
		}
    ?>