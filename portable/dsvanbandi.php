<?php
	if(!isset($_SESSION["MaNSD"])){
		header ("location:index.php?active=home&pages=dang-nhap");
	}
?>
<?php
	require "lib/trangchu.php";
?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){

    // PHƯƠNG THỨC SHOW HÌNH LOADING
    function loading_show(){
        $('#loading').html("<img src='css/img/loading.gif'/>").fadeIn('fast');
    }

    // PHƯƠNG THỨC ẨN HÌNH LOADING
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }             

    // PHƯƠNG THỨC LOAD KẾT QUẢ 
    function loadData(page){
        loading_show();                    
        $.ajax
        ({
            type: "POST",
            url: "data/vanbandi_data.php",
            data: "page="+page,
            success: function(msg)
            {
                $("#container").ajaxComplete(function(event, request, settings)
                {
                    loading_hide();
                    $("#container").html(msg);
                });
            }
        });
    }

    // LOAD GIÁ TRỊ MẶC ĐỊNH PAGE = 1 CHO LẦN ĐẦU TIÊN
    loadData(1);  

    // LOAD KẾT QUẢ CHO TRANG
    $('#container .pagination li.active').live('click',function(){
        var page = $(this).attr('p');
        loadData(page);
    });           

    // PHƯƠNG THỨC DÙNG ĐỂ HIỆN KẾT QUẢ KHI NHẬP GIÁ TRỊ PAGE VÀO TEXTBOX
    // BẠN CÓ THỂ MỞ TEXTBOX LÊN TRONG CLASS PHÂN TRANG
    $('#go_btn').live('click',function(){
        var page = parseInt($('#goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadData(page);
        }else{
            alert('HÃY NHẬP GIÁ TRỊ TỪ 1 ĐẾN '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
    });
});
</script>
<link rel="stylesheet" type="text/css" href="css/table.css"/>
<div style="line-height:30px;margin:5px">
<form name="frmVanbandi" action="" method="post">
<fieldset  style="width:300px;">
<legend>Tìm kiếm</legend>
	<div style="float:left; width:100px"><input type="radio" name="rgTim" value="0" id="rgTim_0"> Số hiệu</div>
    <div style="float:left; width:100px"><input type="radio" name="rgTim" value="1" id="rgTim_1"> Ngày gởi</div>
    <div style="float:left; width:100px"><input type="radio" name="rgTim" value="2" id="rgTim_2" checked="checked"> Nội dung</div>
    <div class="page_danhmuc_clear"></div>
  <label for="txtTim_frmVanbanden"></label>
  <input type="text" name="txtTim_frmVanbandi" id="txtTim_frmVanbandi" />
	
  <input type="submit" name="btnTim_frmVanbandi" id="btnTim_frmVanbandi" value="Tìm" class="redbtvl" />
  <a href="?active=vanbandi&pages=van-ban-di"><input type="button" name="btnlammoi_frmVanbanden" id="btnlammoi_frmVanbanden" value="Làm mới" class="redbtvl" style="width:280px; color:#fff; font-weight:bold" /></a>
  </fieldset>
</form>
</div>
	<?php
	if(isset($_POST["btnTim_frmVanbandi"])){
		$chon = $_POST["rgTim"];
		settype($chon, "int");
		$_tim = $_POST["txtTim_frmVanbandi"];
	?>
	<div class="page_div" style="width:960px; margin-bottom:20px;">
    	<center><div class="mndanhmuc">VĂN BẢN ĐI</div></center>
        <table width="955" border="1" style="margin-top:20px; font-size:11pt">
        	<tr align="center" valign="middle" style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'>
                <td width="80">Số</td>
                <td width="70">Ngày ký</td>
                <td width="70">Ngày gởi</td>
                <td width="225">Tên văn bản</td>
                <td width="250">Nội dung</td>
                <td width="135">CQ nhận</td>
                <td width="65">Biểu mẫu</td>
                <td width="60"><a href='index.php?active=vanbandi&pages=them-van-ban-di'><img src='css/img/add.png' alt='Thêm'/> Thêm</a></td>
          	</tr>
			<?php
			if($chon == 0)
			{
				$vbd = QLVB_VanBanDi_LayTheoSoHieu($_tim);
				while($row = mysql_fetch_array($vbd))
				{
					ob_start();
					?>
				<tr>
					<td align="center" valign="middle"><a href="?active=vanbandi&pages=chi-tiet-van-ban-di&id={MaVB}">{SoHieu}/{KyHieu}</a></td>
					<td align="center" valign="middle">{NgayKy}</td>
                    <td align="center" valign="middle">{NgayGoi}</td>
					<td align="left" valign="middle">{TenVB}</td>
					<td>{NoiDung}</td>
					<td align="center" valign="middle">{CQNhan}</td>
					<td align="center" valign="middle">{MaBM}</td>
					<td align="center" valign="middle">
								<a href='index.php?active=vanbandi&pages=cap-nhat-van-ban-di&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')"  href='index.php?active=vanbandi&pages=xoa-van-ban-di&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a></td>
				</tr>
				 <?php 
					$s= ob_get_clean();
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{KyHieu}",$row["KyHieu"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NgayGoi}",$row["NgayGoi"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{CQNhan}",$row["CQNhan"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					echo $s;
				}
			}
			else if($chon == 1){
				$vbd = QLVB_VanBanDi_LayTheoNgayGoi($_tim);
				while($row = mysql_fetch_array($vbd))
				{
					ob_start();
					?>
				<tr>
					<td align="center" valign="middle"><a href="?active=vanbandi&pages=chi-tiet-van-ban-di&id={MaVB}">{SoHieu}/{KyHieu}</a></td>
					<td align="center" valign="middle">{NgayKy}</td>
                    <td align="center" valign="middle">{NgayGoi}</td>
					<td align="left" valign="middle">{TenVB}</td>
					<td>{NoiDung}</td>
					<td align="center" valign="middle">{CQNhan}</td>
					<td align="center" valign="middle">{MaBM}</td>
					<td align="center" valign="middle">
								<a href='index.php?active=vanbandi&pages=cap-nhat-van-ban-di&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')"  href='index.php?active=vanbandi&pages=xoa-van-ban-di&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a></td>
				</tr>
				 <?php 
					$s= ob_get_clean();
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{KyHieu}",$row["KyHieu"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NgayGoi}",$row["NgayGoi"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{CQNhan}",$row["CQNhan"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					echo $s;
				}
			}
			else
			{
				$vbd = QLVB_VanBanDi_LayTheoNoiDung($_tim);
				while($row = mysql_fetch_array($vbd))
				{
					ob_start();
					?>
				<tr>
					<td align="center" valign="middle"><a href="?active=vanbandi&pages=chi-tiet-van-ban-di&id={MaVB}">{SoHieu}/{KyHieu}</a></td>
					<td align="center" valign="middle">{NgayKy}</td>
                    <td align="center" valign="middle">{NgayGoi}</td>
					<td align="left" valign="middle">{TenVB}</td>
					<td>{NoiDung}</td>
					<td align="center" valign="middle">{CQNhan}</td>
					<td align="center" valign="middle">{MaBM}</td>
					<td align="center" valign="middle">
								<a href='index.php?active=vanbandi&pages=cap-nhat-van-ban-di&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')" href='index.php?active=vanbandi&pages=xoa-van-ban-di&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a></td>
				</tr>
				 <?php 
					$s= ob_get_clean();
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{KyHieu}",$row["KyHieu"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NgayGoi}",$row["NgayGoi"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{CQNhan}",$row["CQNhan"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					echo $s;
				}
			}
			
			?>
		</table>
  </div>
  <?php
	}
	else
	{
  ?>

    <div class="page_div" style="width:960px;margin-bottom:20px;">
        <center><div class="mndanhmuc">VĂN BẢN ĐI</div></center>
        <div id="loading" style="top:300px;"></div>
        <div  id="container" style="margin-top:20px; font-size:11pt">
        <tr class="data" ></tr>
        <div class="pagination" style="text-align:right"></div>
    </div>
    <?php
	}
	
	?>
</div>

<div class="page_danhmuc_clear"></div>
