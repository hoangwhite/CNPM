<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	if(isset($_POST["btnIn"]))
	{
		$chon = $_POST["rgChon"];
		settype($chon,"int");
		if($chon == 0)
		{
			header ("location:./report/dsvanbanden.php");
		}
		else if($chon ==1){
			$_tungay = $_POST["txtTungay"];
			$_denngay = $_POST["txtDenngay"];
			if($_tungay > $_denngay)
			{
				echo "<center><div class='msg1'>Từ ngày không được lớn hơn đến ngày</div></center>";
			}
			else
			{
				header ("location:./report/theongaykyvanbanden.php?tungay=".$_tungay."&denngay=".$_denngay);
			}
		}
		else if($chon ==2){
			$lvb = $_POST["listLoai"];
			settype($lvb,"int"); 
			header ("location:./report/loaivanbanden.php?lvb=".$lvb);
		}
		else if($chon == 3){
			$_tungay = $_POST["txtTungay_den"];
			$_denngay = $_POST["txtDenngay_den"];
			if($_tungay > $_denngay)
			{
				echo "<center><div class='msg1'>Từ ngày không được lớn hơn đến ngày</div></center>";
			}
			else
			{
				header ("location:./report/theongaydenvanbanden.php?tungay=".$_tungay."&denngay=".$_denngay);
			}
		}
	}
?>
<?php 
	require "lib/trangchu.php";
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#txtTungay" ).datepicker();
	$( "#txtDenngay" ).datepicker();
	$( "#txtTungay_den" ).datepicker();
	$( "#txtDenngay_den" ).datepicker();
  });
  </script>
<div class="page_div" style="width:470px; margin-left:25%; margin-top:20px; min-height:150px">
<center><div class="mndanhmuc">VĂN BẢN ĐẾN</div></center>
<form name="form1" method="post" action="">
  <table width="470" border="0" style="margin-top:20px;">
    <tr>
      <td width="474"><input type="radio" name="rgChon" id="dsvbnb" value="0" checked="checked">
        Danh sách văn bản đến.</td>
    </tr>
    <tr>
      <td><input type="radio" name="rgChon" id="dsvbnb2" value="1" /> Ngày ký: &nbsp;
        
        <label for="txtTungay"></label>
        <input name="txtTungay" type="text" id="txtTungay" size="15" readonly="readonly" /> 
        <label for="txtDenngay">đến </label>
        <input name="txtDenngay" type="text" id="txtDenngay" size="15" readonly="readonly" />
        </td>
    </tr>
    <tr>
      <td><input type="radio" name="rgChon" id="dsvbnb4" value="3" />
        Ngày đến: 
        <input name="txtTungay_den" type="text" id="txtTungay_den" size="15" readonly="readonly" /> 
        <label for="txtDenngay_den">đến </label>
        <input name="txtDenngay_den" type="text" id="txtDenngay_den" size="15" readonly="readonly" />
     </td>
    </tr>
    <tr>
      <td><input type="radio" name="rgChon" id="dsvbnb3" value="2" />
        <label for="listLoai">Loại văn bản: </label>
        <select name="listLoai" id="listLoai">
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
      <td align="center"><input type="submit" name="btnIn" id="btnIn" value="In" class="redbtvl" /></td>
    </tr>
  </table>
</form>
</div>
