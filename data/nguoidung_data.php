
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
    $paging->text_sql = "SELECT MaNSD,TaiKhoan, HoTenDem, Ten, NamSinh, DiaChi, (CASE WHEN GioiTinh = '1' THEN 'Nam' ELSE 'Nữ' END) AS 'GioiTinh', phongban.TenPhong as 'MaPB', chucvu.TenCV as 'MaCV', (CASE WHEN TrangThaiLamViec = '1' THEN 'Đang làm' ELSE 'Nghỉ việc' END) AS 'TrangThaiLamViec', groupusers.GrName as 'idGr' FROM nguoidung, phongban, chucvu, groupusers WHERE nguoidung.MaPB = phongban.MaPB AND nguoidung.MaCV = chucvu.MaCV AND nguoidung.idGr = groupusers.idGr ORDER BY nguoidung.idGr";
    $result_pag_data = $paging->GetResult();

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		$message .= "<tr><td style='text-align: center'>" . $row['TaiKhoan'] . "</td><td style='text-align:center;'>". $row['HoTenDem']." ". $row['Ten'] . "</td><td style='text-align: center'>" . $row['NamSinh'] . "</td><td>" . $row['DiaChi'] . "</td><td style='text-align: center'>" . $row['GioiTinh'] . "</td><td>" . $row['MaPB'] . "</td><td>" . $row['MaCV'] . "</td><td style='text-align: center'>" . $row['TrangThaiLamViec'] . "</td><td style='text-align: center'>" . $row['idGr'] . "</td><td style='text-align: center'>" . "		
		<a href='?active=danhmuc&pages=cap-nhat-nguoi-dung&id=".$row['MaNSD']."'><img src='css/img/edit.png' alt='Sửa'/></a><a onclick='return confirmAction()' href='?active=danhmuc&pages=xoa-nguoi-dung&id=".$row['MaNSD']."'><img src='css/img/delete.png' alt='xóa'/></a>". "</td></tr>";
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging->data = "<div><table border='1'><tr style='background-image:url(css/img/bgtt.png); color: #fff; height: 26px'><td style='width: 70px;text-align:center; font-weight:bold'>Tài khoản</td><td style='width: 150px;text-align:center; font-weight:bold;'>Họ & tên</td><td style='width: 80px;text-align:center; font-weight:bold'>Ngày sinh</td><td style='width: 200px;text-align:center; font-weight:bold'>Địa chỉ</td><td style='width: 50px;text-align:center; font-weight:bold'>Giới tính</td><td style='width: 200px;text-align:center; font-weight:bold'>Phòng ban</td><td style='width: 100px;text-align:center; font-weight:bold'>Chức vụ</td><td style='width: 70px;text-align:center; font-weight:bold'>Tình trạng</td><td style='width: 150px;text-align:center; font-weight:bold'>Nhóm quyền</td><td style='width: 40px;text-align:center; font-weight:bold'></td></tr>"."<tr class='data'>" . $message . "</tr></table></div>"; 
	// Content for Data    
	echo $paging->Load();  // KẾT QUẢ TRẢ VỀ
		
} 
?>
<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Anh(chị) có chắc muốn xóa?")
    }
</SCRIPT>
<!--&radic;