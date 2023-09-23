
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
    $paging->text_sql = "SELECT MaVB, SoHieu, KyHieu, NgayDen, TenVB, NoiDung, (CASE WHEN TinhTrangXuLy = 0 THEN 'Chưa xử lý' ELSE 'Đã xử lý' END) as 'TinhTrangXuLy', HanXuLy, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbanden order by NgayDen DESC";
    $result_pag_data = $paging->GetResult();

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		$message .= "<tr><td  align='center' valign='middle'><a class='link' href='index.php?active=vanbanden&pages=chi-tiet-van-ban-den&id=".$row['MaVB']."'>" . $row['SoHieu']."/".$row['KyHieu']. "</a></td><td  align='center' valign='middle'>" . $row['NgayDen']. "</td><td valign='middle'>" . $row['TenVB']. "</td><td valign='middle'>" . $row['NoiDung'] . "</td><td align='center' valign='middle'>". $row['TinhTrangXuLy'] . "</td><td align='center' valign='middle'>". $row['HanXuLy'] . "</td><td align='center' valign='middle'>" . $row['MaBM'] . "</td><td align='center' valign='middle'>" . "
		<a href='index.php?active=vanbanden&pages=cap-nhat-van-ban-den&id=".$row['MaVB']."'><img src='css/img/edit.png' alt='Sửa'/></a> <a onclick='return confirmAction()' href='index.php?active=vanbanden&pages=xoa-van-ban-den&id=".$row['MaVB']."'><img src='css/img/delete.png' alt='Xóa'/></a>". "</td></tr>";
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging->data = "<div><table border='1'><tr style='background-image:url(css/img/mn_table.png); color: #000; height: 28px; font-weight:bold; text-align:center'><td style='width: 80px;'>Số</td><td style='width: 70px;'>Ngày đến</td><td style='width: 225px;'>Tên văn bản</td><td style='width: 300px;'>Nội dung</td><td style='width: 70px;'>Tình trạng</td><td style='width: 70px;'>Hạn xử lý</td><td style='width: 65px;'>Biểu mẫu</td><td style='width: 75px;'><a href='index.php?active=vanbanden&pages=them-van-ban-den'><img src='css/img/add.png' alt='Thêm'/>Thêm</a></td></tr>"."<tr class='data'>" . $message . "</tr></table></div>"; 
	// Content for Data    
	echo $paging->Load();  // KẾT QUẢ TRẢ VỀ
		
} 
?>
<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Anh(chị) có chắc muốn xóa?")
    }
</SCRIPT>