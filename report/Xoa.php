<?php
	require "../lib/dbcon.php";
	require "../lib/trangchu.php";
	$db_number = 0;
	$ck=NULL;
	$_Coquan = QLVB_CoQuan_LayTatCa();
if(isset($_POST['btn']))
{
	while($ro1 = mysql_fetch_array($_Coquan))
	{
		$temp = "ck_".$db_number;
		if(!empty($_POST[$temp]))
		{
			$ck1 = $_POST[$temp];
			if($ck == NULL)
			{
				$ck=$ck1;
			}
			else
			{
				$ck = $ck.','.$ck1;
			}
		}
		$db_number++;
	}
	echo $ck;
}
?>
<form id="form1" name="form1" method="post" action="">
<?php
	
	while ($row_coquan = mysql_fetch_array($_Coquan)){
?>

  <input type="checkbox" name="ck_<?=$db_number?>" value="<?php echo $row_coquan['MaCQ'] ?>"  /> 
  <?php echo $row_coquan['TenCQ']." ck_".$db_number; ?><br />
  
<?php 
		$db_number++;
			}
	?>   
  <p>
    <input type="submit" name="btn" id="btn" value="Submit" />
  </p>
</form>
