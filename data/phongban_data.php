
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
    $paging->text_sql = "SELECT MaPB, TenPhong, (CASE WHEN TrangThai = '1' THEN 'Hoạt động' ELSE 'Ngừng' END) as 'TrangThai', coquan.TenCQ FROM phongban,coquan where phongban.MaCQ = coquan.MaCQ order by phongban.MaCQ";
    $result_pag_data = $paging->GetResult();

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		$message .= "<tr><td style='text-align: center'>" . $row['MaPB'] . "</td><td>" . $row['TenPhong'] . "</td><td
		 style='text-align:center;'>". $row['TrangThai'] . "</td><td>" . $row['TenCQ'] . "</td><td style='text-align: center'>" . "
		
		<a href='index.php?active=danhmuc&pages=cap-nhat-phong-ban&id=".$row['MaPB']."'><img src='css/img/edit.png' alt='Sửa'/></a> <a onclick='return confirmAction()' href='?active=danhmuc&pages=xoa-phong-ban&id=".$row['MaPB']."'><img src='css/img/delete.png' alt='Xóa'/></a>". "</td></tr>";
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging->data = "<div><table border='1'><tr style='background-image:url(css/img/bgtt.png); color: #fff'><td style='width: 60px;text-align:center; font-weight:bold'>Mã PB</td><td style='width: 400px;text-align:center; font-weight:bold'>Phòng Ban</td><td style='width: 100px;text-align:center; font-weight:bold;'>Tình trạng</td><td style='width: 320px;text-align:center; font-weight:bold'>Tên CQ</td><td style='width: 60px;text-align:center; font-weight:bold'></td></tr>"."<tr class='data'>" . $message . "</tr></table></div>"; 
	// Content for Data    
	echo $paging->Load();  // KẾT QUẢ TRẢ VỀ
		
} 
?>
<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Anh(chị) có chắc muốn xóa?")
    }
</SCRIPT>