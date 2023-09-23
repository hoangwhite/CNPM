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
            url: "data/vanbannoibo_data.php",
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
<form name="frmVanbannoibo" action="" method="post">
<fieldset  style="width:300px;">
<legend>Tìm kiếm</legend>
	<div style="float:left; width:100px"><input type="radio" name="rgTim" value="0" id="rgTim_0"> Số hiệu</div>
    <div style="float:left; width:100px"><input type="radio" name="rgTim" value="1" id="rgTim_1"> Ngày ký</div>
    <div style="float:left; width:100px"><input type="radio" name="rgTim" value="2" id="rgTim_2" checked="checked"> Nội dung</div>
    <div class="page_danhmuc_clear"></div>
  <label for="txtTim_frmVanbannoibo"></label>
  <input type="text" name="txtTim_frmVanbannoibo" id="txtTim_frmVanbannoibo" />
	
  <input type="submit" name="btnTim_frmVanbannoibo" id="btnTim_frmVanbannoibo" value="Tìm" class="redbtvl" />
  <a href="index.php?active=danhmuc&pages=van-ban-noi-bo"><input type="button" name="btnlammoi_frmVanbannoibo" id="btnlammoi_frmVanbannoibo" value="Làm mới" class="redbtvl" style="width:280px; color:#fff; font-weight:bold" /></a>
  </fieldset>
</form>
</div>
<?php
		if(isset($_POST['btnTim_frmVanbannoibo']))
		{
			$_ChonTim = $_POST["rgTim"];
			settype($_ChonTim,"int");
			$_Tim = $_POST["txtTim_frmVanbannoibo"]; 
			if($_ChonTim == 0)
			{
				$row_Tim = QLVB_VanBanNoiBo_LayTheoSoHieu($_Tim);
				?>
                <div class="page_div" style="width:950px; margin-bottom:20px;">
  				<center><div class="mndanhmuc">VĂN BẢN NỘI BỘ</div></center>
				<table style="margin-top:20px; font-size:11pt">
                    <tr style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'>
                        <td style='width: 40px;'>Số</td>
                        <td style='width: 200px;'>Tên văn bản</td>
                        <td style='width: 100px;'>Loại văn bản</td>
                        <td style='width: 70px;'>Ngày ký</td>
                        <td style='width: 380px;'>Nội dung</td>
                        <td style='width: 60px;'>Biểu mẫu</td>
                        <td style='width: 90px;'><a href='index.php?active=vanbannoibo&pages=them-van-ban-noi-bo'><img src='css/img/add.png' alt='Thêm'/> Thêm</a></td>
                </tr> 
                <?php
				while($row = mysql_fetch_array($row_Tim))
				{
					ob_start();
					
					?>
                    	<tr>
                            <td align="center" valign="middle">{SoHieu}</td>
                            <td align="center" valign="middle"><a style='text-decoration:none; color:#00C' href='index.php?active=vanbannoibo&pages=chi-tiet-van-ban-noi-bo&id={MaVB}'>{TenVB}</a></td>
                            <td align="center" valign="middle">{TenLVB}</td>
                            <td align="center" valign="middle">{NgayKy}</td>
                            <td> {NoiDung}</td>
                            <td align="center" valign="middle">{MaBM}</td>
                            <td align="center" valign="middle">
                <a href='index.php?active=vanbannoibo&pages=cap-nhat-van-ban-noi-bo&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')" href='index.php?active=vanbannoibo&pages=xoa-van-ban-noi-bo&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a>
                			</td>
                		</tr>
                    <?php 
					$s= ob_get_clean();
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{TenLVB}",$row["TenLVB"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					echo $s;
				}
				?>
            </table>
            </div>
            <?php
			}
			else if($_ChonTim == 1)
			{
				$row_Tim = QLVB_VanBanNoiBo_LayTheoNgayKy($_Tim);
				?>
                <div class="page_div" style="width:950px; margin-bottom:20px;">
  				<center><div class="mndanhmuc">VĂN BẢN NỘI BỘ</div></center>
				<table style="margin-top:20px; font-size:11pt">
                    <tr style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'>
                        <td style='width: 40px;'>Số</td>
                        <td style='width: 200px;'>Tên văn bản</td>
                        <td style='width: 100px;'>Loại văn bản</td>
                        <td style='width: 70px;'>Ngày ký</td>
                        <td style='width: 380px;'>Nội dung</td>
                        <td style='width: 60px;'>Biểu mẫu</td>
                        <td style='width: 90px;'><a href='index.php?active=vanbannoibo&pages=them-van-ban-noi-bo'><img src='css/img/add.png' alt='Thêm'/> Thêm</a></td>
                </tr> 
                <?php
				while($row = mysql_fetch_array($row_Tim))
				{
					ob_start();
					?>
                    	<tr>
                            <td align="center" valign="middle">{SoHieu}</td>
                            <td align="center" valign="middle"><a style='text-decoration:none; color:#00C' href='index.php?active=vanbannoibo&pages=chi-tiet-van-ban-noi-bo&id={MaVB}'>{TenVB}</a></td>
                            <td align="center" valign="middle">{TenLVB}</td>
                            <td align="center" valign="middle">{NgayKy}</td>
                            <td> {NoiDung}</td>
                            <td align="center" valign="middle">{MaBM}</td>
                            <td align="center" valign="middle">
                <a href='index.php?active=vanbannoibo&pages=cap-nhat-van-ban-noi-bo&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')" href='index.php?active=vanbannoibo&pages=xoa-van-ban-noi-bo&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a>
                			</td>
                		</tr>
                    <?php 
					$s= ob_get_clean();
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{TenLVB}",$row["TenLVB"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					echo $s;
				}
				?>
            </table>
            </div>
            <?php
			}
			else
			{
				$row_Tim = QLVB_VanBanNoiBo_LayTheoNoiDung($_Tim);
				?>
                <div class="page_div" style="width:950px;margin-bottom:20px;">
  				<center><div class="mndanhmuc">VĂN BẢN NỘI BỘ</div></center>
				<table style="margin-top:20px; font-size:11pt">
                    <tr style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'>
                        <td style='width: 40px;'>Số</td>
                        <td style='width: 200px;'>Tên văn bản</td>
                        <td style='width: 100px;'>Loại văn bản</td>
                        <td style='width: 70px;'>Ngày ký</td>
                        <td style='width: 380px;'>Nội dung</td>
                        <td style='width: 60px;'>Biểu mẫu</td>
                        <td style='width: 90px;'><a href='index.php?active=vanbannoibo&pages=them-van-ban-noi-bo'><img src='css/img/add.png' alt='Thêm'/> Thêm</a></td>
                </tr> 
                <?php
				while($row = mysql_fetch_array($row_Tim))
				{
					ob_start();
					?>
                    	<tr>
                            <td align="center" valign="middle">{SoHieu}</td>
                            <td align="center" valign="middle"><a style='text-decoration:none; color:#00C' href='index.php?active=vanbannoibo&pages=chi-tiet-van-ban-noi-bo&id={MaVB}'>{TenVB}</a></td>
                            <td align="center" valign="middle">{TenLVB}</td>
                            <td align="center" valign="middle">{NgayKy}</td>
                            <td> {NoiDung}</td>
                            <td align="center" valign="middle">{MaBM}</td>
                            <td align="center" valign="middle">
                <a href='index.php?active=vanbannoibo&pages=cap-nhat-van-ban-noi-bo&id={MaVB}'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick="return confirm('Anh(chị) có chắc muốn xóa?')" href='index.php?active=vanbannoibo&pages=xoa-van-ban-noi-bo&id={MaVB}'><img src='css/img/delete.png' alt='Xóa'/></a>
                			</td>
                		</tr>
                    <?php 
					$s= ob_get_clean();
					$s = str_replace("{SoHieu}",$row["SoHieu"],$s);
					$s = str_replace("{TenVB}",$row["TenVB"],$s);
					$s = str_replace("{TenLVB}",$row["TenLVB"],$s);
					$s = str_replace("{NgayKy}",$row["NgayKy"],$s);
					$s = str_replace("{NoiDung}",$row["NoiDung"],$s);
					$s = str_replace("{MaBM}",$row["MaBM"],$s);
					$s = str_replace("{MaVB}",$row["MaVB"],$s);
					echo $s;
				}
				?>
            </table>
            </div>
            <?php
			}
		}
		else
		{
?>
<div class="page_div" style="width:950px;margin-bottom:20px;">
	<center><div class="mndanhmuc">VĂN BẢN NỘI BỘ</div></center>
    <div id="loading" style="top:300px;"></div>
    <div  id="container" style="margin-top:20px; font-size:11pt">

        <tr class="data" ></tr>
    
     <div class="pagination" style="text-align:right"></div>
     </div>
</div>
<?php } ?>
<div class="page_danhmuc_clear"></div>