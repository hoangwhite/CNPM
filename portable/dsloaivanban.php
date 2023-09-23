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
            url: "data/loaivanban_data.php",
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
<div>
	<div style="float:left; line-height:30px; margin:5px;">Chỉ mục: </div>
	<div class="chimuc"><a href="index.php?active=danhmuc&pages=danh-muc" style=" text-decoration: none; color:#000;">Danh mục </a> </div>
   <div style="float:left; line-height:30px; margin:5px;"><img src="css/img/muiten.png" /></div>
    <div class="chimuc"><a href="index.php?active=danhmuc&pages=dslcv" style="text-decoration: none; color:#000;">Quản lý loại văn bản</a></div>
</div>
<div style="line-height:30px;margin:5px">
<form name="frmLoaicongvan" action="" method="post">
  <label for="txtTim_frmLoaicongvan">Tên loại văn bản: </label>
  <input type="text" name="txtTim_frmLoaicongvan" id="txtTim_frmLoaicongvan" />
	
  <input type="submit" name="btnTim_frmLoaicongvan" id="btnTim_frmLoaicongvan" value="Tìm" class="redbtvl" />
</form>
</div>
<?php
		if(isset($_POST['btnTim_frmLoaicongvan']))
		{
			$_Tim = $_POST["txtTim_frmLoaicongvan"]; 
			
			$row_loaicongvan = QLVB_LoaiCongVan_LaytheoTenLCV($_Tim);			
?>
<div class="page_div" style="width:770px; margin-left:100px;">
	<center><div class="mndanhmuc">DANH SÁCH LOẠI VĂN BẢN</div></center>
    <div><a href='?active=danhmuc&pages=them-loai-cong-van'><img src='css/img/add.png' alt='Thêm'/> Thêm mới</a></div>
		<table style="margin-top:5px; font-size:11pt">
        <tr style='background-image:url(css/img/bgtt.png); color: #fff; height: 26px; font-weight:bold; text-align:center'>
        	<td>Mã LVB</td>
            <td>Tên LVB</td>
            <td>Ghi chú</td>
            <td>Tình trạng</td>
            <td></td>
        </tr> 
<?php
			while($row = mysql_fetch_array($row_loaicongvan))
			{
				ob_start();
?>
				<tr>
                	<td style='width: 60px;text-align:center;'>{MaLVB}</td>
                    <td style='width: 190px;padding-left:10px;'>{TenLVB}</td>
                    <td style='width: 350px;'>{GhiChu}</td>
                    <td style='width: 100px;text-align:center;'>{TrangThai}</td>
                    <td>
		<a href='index.php?active=danhmuc&pages=cap-nhat-loai-cong-van&id={MaLVB}'><img src='css/img/edit.png' alt='Sửa'/></a> <a onclick='return confirm("Anh(chị) có chắc muốn xóa?")' href='?active=danhmuc&pages=xoa-loai-cong-van&id={MaLVB}'><img src='css/img/delete.png' alt='xóa'/></a></td>
                </tr>
<?php
				$s= ob_get_clean();
				$s = str_replace("{MaLVB}",$row["MaLVB"],$s);
				$s = str_replace("{TenLVB}",$row["TenLVB"],$s);
				$s = str_replace("{GhiChu}",$row["GhiChu"],$s);
				$s = str_replace("{TrangThai}",$row["TrangThai"],$s);
				echo $s;
			}
?>
        </table>
        </div>
<?php
			
		}
		else
		{
?>
<div class="page_div" style="width:770px; margin-left:100px;">
	<center><div class="mndanhmuc">DANH SÁCH LOẠI VĂN BẢN</div></center>
    <div id="loading"></div>
    <div><a href='?active=danhmuc&pages=them-loai-cong-van'><img src='css/img/add.png' alt='Thêm'/> Thêm mới</a></div>
    <div  id="container" style="margin-top:5px; font-size:11pt">

        <tr class="data" ></tr>
    
     <div class="pagination" style="text-align:right"></div>
     </div>
</div>
<?php } ?>
<div class="page_danhmuc_clear"></div>