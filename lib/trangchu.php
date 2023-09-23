<?php
		// Hàm lấy tất cả cơ quan
function QLVB_CoQuan_LayTatCa(){

	$qr = "select * from coquan";
	return mysql_query($qr);
}

//lấy cơ quan sử dụng 
function QLVB_CoQuan_CQSuDung()
{
	$qr = "
		Select * from coquan where MaCQ = 1
	";
	$cq = mysql_query($qr);
	return mysql_fetch_array($cq);
}
//phan trang cơ quan
function QLVB_CoQuan_LayTatCa_PhanTrang($tudong, $sotin1trang){
	$qr = "
			SELECT * FROM coquan LIMIT $tudong, $sotin1trang
	";
	return mysql_query($qr);
}

//lấy cơ quan theo macq
function QLVB_CoQuan_LaytheoMaCQ($MaCQ)
{
	$qr = "
	SELECT * FROM coquan where MaCQ = '$MaCQ'
	";
	$cq = mysql_query($qr);
	return mysql_fetch_array($cq);
}

// Hàm lấy tất cả phòng ban
function QLVB_PhongBan_LayTatCa(){

	$qr = "select * from phongban";
	return mysql_query($qr);
}
//lấy phòng ban theo macq
function QLVB_PhongBan_LaytheoMaPB($MaPB)
{
	$qr = "
	SELECT * FROM phongban where MaPB = '$MaPB'
	";
	$pb = mysql_query($qr);
	return mysql_fetch_array($pb);
}
//lấy phòng ban theo maCQ
function QLVB_PhongBan_LayTheoMaCQ($MaCQ)
{
	$qr = "
			Select * from phongban where MaCQ = '$MaCQ'
	";
	return mysql_query($qr);
}

// Hàm lấy tất cả chức vụ
function QLVB_ChucVu_LayTatCa(){

	$qr = "select * from chucvu";
	return mysql_query($qr);
}
//lấy chức vụ theo mã CV
function QLVB_ChucVu_LaytheoMaCV($MaCV)
{
	$qr = "
				SELECT * from chucvu WHERE MaCV='$MaCV'
	";
	$cv = mysql_query($qr);
	return mysql_fetch_array($cv);
}

// Hàm chức vụ theo tên
function QLVB_ChucVu_LayTheoTen($TenCV){

	$qr = "SELECT MaCV, TenCV, GhiChu, (CASE WHEN TrangThai = '1' THEN 'Hoạt động' ELSE 'Ngừng' END) AS 'TrangThai' from chucvu where TenCV like '%$TenCV%'";
	return mysql_query($qr);
}
// Hàm lấy tất cả nhóm quyền
function QLVB_groupusers_LayTatCa(){

	$qr = "select * from groupusers";
	return mysql_query($qr);
}

// lấy tất cả người dùng
function QLVB_NguoiDung_LayTatCa(){
	$qr = "
			SELECT MaNSD,TaiKhoan, HoTenDem, Ten, NamSinh, DiaChi, (CASE WHEN GioiTinh = '1' THEN 'Nam' ELSE 'Nữ' END) AS 'GioiTinh', phongban.TenPhong as 'MaPB', chucvu.TenCV as 'MaCV', (CASE WHEN TrangThaiLamViec = '1' THEN 'Đang làm' ELSE 'Nghỉ việc' END) AS 'TrangThaiLamViec', groupusers.GrName as 'idGr' FROM nguoidung, phongban, chucvu, groupusers WHERE nguoidung.MaPB = phongban.MaPB AND nguoidung.MaCV = chucvu.MaCV AND nguoidung.idGr = groupusers.idGr ORDER BY nguoidung.idGr
	";
	return mysql_query($qr);
}
//Phân trang
function QLVB_NguoiDung_LayTatCa_PhanTrang($tudong, $sotin1trang){
	$qr = "
			SELECT MaNSD,TaiKhoan, HoTenDem, Ten, NamSinh, DiaChi, (CASE WHEN GioiTinh = '1' THEN 'Nam' ELSE 'Nữ' END) AS 'GioiTinh', phongban.TenPhong as 'MaPB', chucvu.TenCV as 'MaCV', (CASE WHEN TrangThaiLamViec = '1' THEN 'Đang làm' ELSE 'Nghỉ việc' END) AS 'TrangThaiLamViec', groupusers.GrName as 'idGr' FROM nguoidung, phongban, chucvu, groupusers WHERE nguoidung.MaPB = phongban.MaPB AND nguoidung.MaCV = chucvu.MaCV AND nguoidung.idGr = groupusers.idGr ORDER BY nguoidung.idGr LIMIT $tudong, $sotin1trang
	";
	return mysql_query($qr);
}

// lấy người dùng theo mansd
function QLVB_NguoiDung_LaytheoMaNSD($MaNSD)
{
	$qr = "
	SELECT * FROM nguoidung where MaNSD = '$MaNSD'
	";
	$nguoidung = mysql_query($qr);
	return mysql_fetch_array($nguoidung);
}

// Hàm lấy tất cả người dùng được duyệt lãnh đạo
function QLVB_NguoiDung_LayTatCaDuyetLanhDao(){

	$qr = "select * from nguoidung where DuyetLanhDao=1";
	return mysql_query($qr);
}

// lấy loại công văn theo tên loại công văn
function QLVB_LoaiCongVan_LaytheoTenLCV($TenLVB)
{
	$qr = "
	SELECT MaLVB, TenLVB, GhiChu, (CASE WHEN TrangThai = '1' THEN 'Hoạt động' ELSE 'Ngừng' END) AS 'TrangThai' from loaivanban Where TenLVB like '%$TenLVB%'
	";
	return mysql_query($qr);
}

//lấy loại công văn theo mã CV
function QLVB_LoaiCongVan_LaytheoMaLCV($MaLVB)
{
	$qr = "
			SELECT * from loaivanban WHERE MaLVB='$MaLVB'
	";
	$lcv = mysql_query($qr);
	return mysql_fetch_array($lcv);
}
// Hàm lấy tất cả loại văn ban
function QLVB_LoaiVanBan_LayTatCa(){

	$qr = "select * from loaivanban";
	return mysql_query($qr);
}

// Văn bản nội bộ
// LẤy theo số hiệu văn bản
function QLVB_VanBanNoiBo_LayTheoSoHieu($_SoHieu)
{
	$qr = "
	SELECT MaVB,TenVB, SoHieu, loaivanban.TenLVB as 'TenLVB', NgayKy, NoiDung, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'có' END) as 'MaBM' FROM vanbannoibo, loaivanban where vanbannoibo.MaLVB = loaivanban.MaLVB and SoHieu = '$_SoHieu' order by MaVB DESC
	";
	return  mysql_query($qr);
}
//Lấy theo ngày ký
function QLVB_VanBanNoiBo_LayTheoNgayKy($_NgayKy)
{
	$qr = "
	SELECT MaVB,TenVB, SoHieu, loaivanban.TenLVB as 'TenLVB', NgayKy, NoiDung, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'có' END) as 'MaBM' FROM vanbannoibo, loaivanban where vanbannoibo.MaLVB = loaivanban.MaLVB and NgayKy like '%$_NgayKy%' order by MaVB DESC
	";
	return mysql_query($qr);
}

//Lấy theo Nội dung
function QLVB_VanBanNoiBo_LayTheoNoiDung($_Noidung)
{
	$qr = "
	SELECT MaVB,TenVB, SoHieu, loaivanban.TenLVB as 'TenLVB', NgayKy, NoiDung, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'có' END) as 'MaBM' FROM vanbannoibo, loaivanban where vanbannoibo.MaLVB = loaivanban.MaLVB and NoiDung like '%$_Noidung%' order by MaVB DESC
	";
	return mysql_query($qr);
}

//Lấy theo mã văn bản nội bộ
function QLVB_VanBanNoiBo_LayTheoMa($MaVB)
{
	$qr = "
			SELECT TenVB, SoHieu, KyHieu, NgayKy, NgayLuu, vanbannoibo.MaLVB as 'MaLVB1', loaivanban.TenLVB as 'MaLVB', nguoidung.HoTenDem as 'HoTenDem', nguoidung.Ten as 'Ten', NoiDung, TailieuDinhKem , PBNhan, LanhDaoDuyet, NoiDungDuyet, MaBM FROM vanbannoibo, nguoidung, loaivanban WHERE vanbannoibo.MaLVB = loaivanban.MaLVB and vanbannoibo.MaNSD = nguoidung.MaNSD and MaVB='$MaVB' 
	";
	$vbnb = mysql_query($qr);
	return mysql_fetch_array($vbnb);
}
//Báo cáo văn bản nội bộ
function QLVB_VanBanNoiBo_DanhSachVBNB()
{
	$qr = "
			SELECT SoHieu, KyHieu, NgayKy, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbannoibo, bieumau WHERE vanbannoibo.MaBM = bieumau.MaBM order by MaVB
	";
	return mysql_query($qr);
}
// báo cáo văn bản nội bộ theo ngày
function QLVB_VanBanNoiBo_DanhSachVBNBTheoNgay($tungay1, $denngay1)
{
	$qr = "
			SELECT SoHieu, KyHieu, NgayKy, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbannoibo, bieumau WHERE vanbannoibo.MaBM = bieumau.MaBM and NgayKy BETWEEN '$tungay1' and '$denngay1' order by MaVB
	";
	return mysql_query($qr);
}
// báo cáo văn bản nội bộ theo loại văn bản
function QLVB_VanBanNoiBo_DanhSachVBNBTheoLVB($loaivanban)
{
	$qr = "
			SELECT SoHieu, KyHieu, NgayKy, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbannoibo, bieumau WHERE vanbannoibo.MaBM = bieumau.MaBM and MaLVB = '$loaivanban'  order by MaVB
	";
	return mysql_query($qr);
}

//Biễu mẫu
// lấy biểu mẫu cuối cùng
function QLVB_BieuMau_LayBieuMauCuoiCung()
{
	$qr = "
			SELECT * from bieumau order by MaBM DESC limit 0,1
	";
	$bm = mysql_query($qr);
	return mysql_fetch_array($bm);
}

//Lấy theo mã biểu mẫu
function QLVB_BieuMau_LayTheoMa($MaBM)
{
	$qr = "
			SELECT * from bieumau WHERE MaBM='$MaBM'
	";
	$bm = mysql_query($qr);
	return mysql_fetch_array($bm);
}
// Hàm lấy tất cả loại văn ban
function QLVB_BieuMau_LayTatCa(){

	$qr = "select * from bieumau";
	return mysql_query($qr);
}

//Văn bản đến
//lấy tất cả văn bản đến
function QLVB_VanBanDen_DanhSach()
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayDen, TenVB, NoiDung, DuyetLanhDao, bieumau.SoLuong as 'SLBM' FROM vanbanden, bieumau WHERE vanbanden.MaBM = bieumau.MaBM order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản theo ngày ký
function QLVB_VanBanDen_DanhSachTheoNgayKy($tungay, $denngay)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayDen, TenVB, NoiDung, DuyetLanhDao, bieumau.SoLuong as 'SLBM' FROM vanbanden, bieumau WHERE vanbanden.MaBM = bieumau.MaBM and NgayKy BETWEEN '$tungay' and '$denngay'  order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản theo ngày đén
function QLVB_VanBanDen_DanhSachTheoNgayDen($tungay, $denngay)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayDen, TenVB, NoiDung, DuyetLanhDao, bieumau.SoLuong as 'SLBM' FROM vanbanden, bieumau WHERE vanbanden.MaBM = bieumau.MaBM and NgayDen BETWEEN '$tungay' and '$denngay'  order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản theo loại văn bản đến
function QLVB_VanBanDen_DanhSachTheoLoai($loai)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayDen, TenVB, NoiDung, DuyetLanhDao, bieumau.SoLuong as 'SLBM' FROM vanbanden, bieumau WHERE vanbanden.MaBM = bieumau.MaBM and MaLVB = '$loai'  order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản đến theo số hiệu
function QLVB_VanBanDen_LayTheoSoHieu($SoHieu)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayDen, TenVB, NoiDung, (CASE WHEN TinhTrangXuLy = 0 THEN 'Chưa xử lý' ELSE 'Đã xử lý' END) as 'TinhTrangXuLy', HanXuLy, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbanden where SoHieu='$SoHieu' order by NgayDen DESC
	";
	return mysql_query($qr);
}

// lấy văn bản đến theo ngay đến
function QLVB_VanBanDen_LayTheoNgayDen($Ngayden)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayDen, TenVB, NoiDung, (CASE WHEN TinhTrangXuLy = 0 THEN 'Chưa xử lý' ELSE 'Đã xử lý' END) as 'TinhTrangXuLy', HanXuLy, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbanden where NgayDen like '%$Ngayden%' order by NgayDen DESC
	";
	return mysql_query($qr);
}
// lấy văn bản đến theo nội dung
function QLVB_VanBanDen_LayTheoNoiDung($Noidung)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayDen, TenVB, NoiDung, (CASE WHEN TinhTrangXuLy = 0 THEN 'Chưa xử lý' ELSE 'Đã xử lý' END) as 'TinhTrangXuLy', HanXuLy, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbanden where NoiDung like'%$Noidung%' order by NgayDen DESC
	";
	return mysql_query($qr);
}
//Lấy theo mã văn bản đến
function QLVB_VanBanDen_LayTheoMa($MaVB)
{
	$qr = "
			SELECT MaVB, TenVB, SoHieu, KyHieu,NgayKy, NgayDen, TenLVB as 'MaLVB', TenCQ as 'MaCQ', MucDoKhan, MucDoMat, MaNSD, NoiDung, TaiLieuDinhKem, CVDTheoDuong, TenNVDen, TinhTrangXuLy, HanXuLy, NoiDungXuLy, PhongBanXuLy, DuyetLanhDao, NoiDungDuyet, MaBM FROM vanbanden, loaivanban, coquan WHERE vanbanden.MaLVB = loaivanban.MaLVB AND vanbanden.MaCQ = coquan .MaCQ and MaVB='$MaVB' 
	";
	$vbd = mysql_query($qr);
	return mysql_fetch_array($vbd);
}

// Văn bản đi
// chi tiết văn bản đi
function QLVB_VanBanDi_LayTheoMa($mavb){
	$qr = "
		select *, loaivanban.TenLVB as 'TenLVB' from vanbandi, loaivanban where vanbandi.MaLVB = loaivanban.MaLVB and MaVB = '$mavb'
	";
	$vbdi = mysql_query($qr);
	return mysql_fetch_array($vbdi);
}
//văn bản đi lấy theo số hiệu
function QLVB_VanBanDi_LayTheoSoHieu($SoHieu)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, CQNhan, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbandi Where SoHieu = '$SoHieu'
	";
	return mysql_query($qr);
}
//văn bản đi lấy theo ngày gởi
function QLVB_VanBanDi_LayTheoNgayGoi($Ngaygoi)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, CQNhan, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbandi Where NgayGoi like '%$Ngaygoi%'
	";
	return mysql_query($qr);
}
//văn bản đi lấy theo nội dung
function QLVB_VanBanDi_LayTheoNoiDung($noidung)
{
	$qr = "
			SELECT MaVB, SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, CQNhan, (CASE WHEN MaBM = 0 THEN 'Không' ELSE 'Có' END) as 'MaBM' FROM vanbandi Where NoiDung like '%$noidung%'
	";
	return mysql_query($qr);
}
//Lấy danh sách văn bản đi
function QLVB_VanBanDi_DanhSach()
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbandi, bieumau WHERE vanbandi.MaBM = bieumau.MaBM order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản đi theo ngày ký
function QLVB_VanBanDi_DanhSachTheoNgayKy($tungay, $denngay)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbandi, bieumau WHERE vanbandi.MaBM = bieumau.MaBM and NgayKy BETWEEN '$tungay' and '$denngay'  order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản đi theo ngày gởi
function QLVB_VanBanDi_DanhSachTheoNgayGoi($tungay, $denngay)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbandi, bieumau WHERE vanbandi.MaBM = bieumau.MaBM and NgayGoi BETWEEN '$tungay' and '$denngay'  order by MaVB
	";
	return mysql_query($qr);
}
// lấy văn bản theo loại văn bản đến
function QLVB_VanBanDi_DanhSachTheoLoai($loai)
{
	$qr = "
		SELECT SoHieu, KyHieu, NgayKy, NgayGoi, TenVB, NoiDung, LanhDaoDuyet, bieumau.SoLuong as 'SLBM' FROM vanbandi, bieumau WHERE vanbandi.MaBM = bieumau.MaBM and MaLVB = '$loai'  order by MaVB
	";
	return mysql_query($qr);
}
?>