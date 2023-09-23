
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
    $paging->text_sql = "SELECT MaCV, TenCV, GhiChu, (CASE WHEN TrangThai = '1' THEN 'Hoạt động' ELSE 'Ngừng' END) AS 'TrangThai' from chucvu";
    $result_pag_data = $paging->GetResult();

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		$message .= "<tr><td style='text-align: center'>" . $row['MaCV'] . "</td><td style='padding-left:10px;'>" . $row['TenCV'] . "</td><td>". $row['GhiChu']."</td><td style='text-align: center'>" . $row['TrangThai'] . "</td><td style='text-align: center'>
		<a href='index.php?active=danhmuc&pages=cap-nhat-chuc-vu&id=".$row['MaCV']."'><img src='css/img/edit.png' alt='Sửa'/></a>
		<a onclick='return confirmAction()' href='index.php?active=danhmuc&pages=xoa-chuc-vu&id=".$row['MaCV']."'><img src='css/img/delete.png' alt='xóa'/></a>". "</td></tr>";
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging->data = "<div><table border='1'><tr style='background-image:url(css/img/bgtt.png); color: #fff; height: 26px'><td style='width: 60px;text-align:center; font-weight:bold'>Mã CV</td><td style='width: 200px;text-align:center; font-weight:bold'>Tên CV</td><td style='width: 350px;text-align:center; font-weight:bold;'>Ghi chú</td><td style='width: 100px;text-align:center; font-weight:bold'>Tình trạng</td><td></td></tr>"."<tr class='data'>" . $message . "</tr></table></div>"; 
	// Content for Data    
	echo $paging->Load();  // KẾT QUẢ TRẢ VỀ
		
} 
?>
<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Anh(chị) có chắc muốn xóa?")
    }
</SCRIPT>