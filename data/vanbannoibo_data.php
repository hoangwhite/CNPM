
<?php

// KIỂM TRA TỒN TẠI PAGE HAY KHÔNG
if(isset($_POST["page"]))
{
	// ĐƯA 2 FILE VÀO TRANG & KHỞI TẠO CLASS
	require "../lib/dbcon.php";
	include_once "../ajax/paging_ajax.php";
	$paging = new paging_ajax();
	
	
	// ĐẶT CLASS CHO THÀNH PHẦN PHÂN TRANG THEO Ý MUỐN
	$paging->class_pagination = "pagination";
	$paging->class_active = "active";
	$paging->class_inactive = "inactive";
	$paging->class_go_button = "go_button";
	$paging->class_text_total = "total";
	$paging->class_txt_goto = "txt_go_button";

	// KHỞI TẠO SỐ PHẦN TỬ TRÊN TRANG
    $paging->per_page = 15; 	
    
    // LẤY GIÁ TRỊ PAGE THÔNG QUA PHƯƠNG THỨC POST
    $paging->page = $_POST["page"];
    
    // VIẾT CÂU TRUY VẤN & LẤY KẾT QUẢ TRẢ VỀ
    $paging->text_sql = "SELECT MaVB,TenVB, SoHieu, loaivanban.TenLVB as 'TenLVB', NgayKy, NoiDung, (CASE WHEN MaBM = 0   THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbannoibo, loaivanban where vanbannoibo.MaLVB = loaivanban.MaLVB order by MaVB DESC";
    $result_pag_data = $paging->GetResult();

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		$message .= "<tr><td  align='center' valign='middle'>" . $row['SoHieu']. "</td><td  align='center' valign='middle'><a style='text-decoration:none; color:#00C' href='index.php?active=vanbannoibo&pages=chi-tiet-van-ban-noi-bo&id=".$row['MaVB']."'>" . $row['TenVB']. "</a></td><td align='center' valign='middle'>" . $row['TenLVB']. "</td><td align='center' valign='middle'>" . $row['NgayKy'] . "</td><td>". $row['NoiDung'] . "</td><td align='center' valign='middle'>" . $row['MaBM'] . "</td><td align='center' valign='middle'>" . "
		
		<a href='index.php?active=vanbannoibo&pages=cap-nhat-van-ban-noi-bo&id=".$row['MaVB']."'><img src='css/img/edit.png' alt='Sửa'/></a> <a onclick='return confirmAction()' href='index.php?active=vanbannoibo&pages=xoa-van-ban-noi-bo&id=".$row['MaVB']."'><img src='css/img/delete.png' alt='Xóa'/></a>". "</td></tr>";
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging->data = "<div><table border='1'><tr style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'><td style='width: 40px;'>Số</td><td style='width: 200px;'>Tên văn bản</td><td style='width: 100px;'>Loại văn bản</td><td style='width: 70px;'>Ngày ký</td><td style='width: 380px;'>Nội dung</td><td style='width: 60px;'>Biểu mẫu</td><td style='width: 90px;'><a href='index.php?active=vanbannoibo&pages=them-van-ban-noi-bo'><img src='css/img/add.png' alt='Thêm'/> Thêm</a></td></tr>"."<tr class='data'>" . $message . "</tr></table></div>"; 
	// Content for Data    
	echo $paging->Load();  // KẾT QUẢ TRẢ VỀ
		
} 
?>
<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Anh(chị) có chắc muốn xóa?")
    }
</SCRIPT>