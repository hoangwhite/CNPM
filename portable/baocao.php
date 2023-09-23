<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	if(isset($_POST["btnXem"])){
		$chon_BC = $_POST["rgbaocao"];
		settype($chon_BC,"int");
		if($chon_BC==0)
		{
			header ("location:index.php?active=baocao&pages=bao-cao-vbnb");
		}
		else if($chon_BC==1)
		{
			header ("location:index.php?active=baocao&pages=bao-cao-vbden");
		}
		else if($chon_BC==2)
		{
			header ("location:index.php?active=baocao&pages=bao-cao-vbdi");
		}
		else
		{
			header ("location:index.php?active=baocao&pages=bao-cao-vbnb");
		}
	}
?>
<div class="page_div" style="width:300px; margin-left:25%; margin-top:20px; min-height:150px">
<center><div class="mndanhmuc">VĂN BẢN</div></center>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="0" style="margin-top:20px">
    <tr>
      <td align="right"><input name="rgbaocao" type="radio" id="rgbaocao" value="0" checked="checked" /></td>
      <td> Văn bản nội bộ</td>
    </tr>
    <tr>
      <td align="right"><input type="radio" name="rgbaocao" id="rgbaocao2" value="1" /></td>
      <td> Văn bản đến</td>
    </tr>
    <tr>
      <td align="right"><input type="radio" name="rgbaocao" id="rgbaocao3" value="2" /></td>
        <td> Văn bản đi</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnXem" id="btnXem" value="Xem"  class="redbtvl" /></td>
    </tr>
  </table>
</form>
</div>
