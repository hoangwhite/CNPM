<?php
	session_start();
	require "lib/dbcon.php";
?>
<?php
	if(!isset($_REQUEST["active"])) $active="vanbannoibo";
	else $active=$_REQUEST["active"];
                switch ($active) {
                        case 'vanbannoibo':
                        		$class0="class='current'";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                        case 'danhmuc':
                        		$class1="class='current'";
                        		$class0="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                        case 'vanbanden':
                        		$class2="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class3="";
                        		$class4="";
                              break;
                              
                        case 'vanbandi':
                              	$class3="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class2="";
                        		$class4="";
                              break;
                        case 'baocao':
                             	$class4="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                              break;
                        default: 
                             	$class0="class='current'";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                  }
?>
<?php
if(isset($_GET["pages"])){
		 $pages = $_GET["pages"];
	 }
	 else
	 	$pages = "";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; chrome=1" />
<title>Quản lý văn bản</title>
<link rel="stylesheet" type="text/css" href="css/menu.css"/>
<link rel="stylesheet" type="text/css" href="css/site.css"/>
<link rel="stylesheet" type="text/css" href="css/danhmuc.css"/>
<script type="text/javascript" src="script/doimau.js"></script>
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
<div id="wappers">
    <div class="logo_top" style="text-align:right; color:white; font-weight:bold; padding-right:10px; padding-top:10px;"> 
        <?php require "blocks/xinchao.php";?>
    </div>
    <div style="margin-top:-10px;">
            <?php
                require "blocks/menu_top.php";
            ?>
    </div>
            <?php
                switch ($pages) {
                        case "danh-muc": require "portable/danhmuc.php";
                            break;
					  	case "dang-nhap": require "portable/dangnhap.php";
					  		break;
						case "dsnd": require "portable/dsnguoidung.php";
					  		break;
						case "them-nguoi-dung": require "portable/themnguoidung.php";
					  		break;
						case "cap-nhat-nguoi-dung": require "portable/suanguoidung.php";
					  		break;
						case "xoa-nguoi-dung": require "portable/xoanguoidung.php";
					  		break;	
						case "dscq": require "portable/dscoquan.php";
					  		break;
						case "cap-nhat-co-quan": require "portable/suacoquan.php";
					  		break;
						case "xoa-co-quan": require "portable/xoacoquan.php";
					  		break;	
						case "them-co-quan": require "portable/themcoquan.php";
					  		break;
						case "dspb": require "portable/dsphongban.php";
					  		break;
						case "them-phong-ban": require "portable/themphongban.php";
					  		break;
						case "cap-nhat-phong-ban": require "portable/suaphongban.php";
					  		break;
						case "xoa-phong-ban": require "portable/xoaphongban.php";
					  		break;	
						case "dscv": require "portable/dschucvu.php";
					  		break;
						case "them-chuc-vu": require "portable/themchucvu.php";
					  		break;
						case "cap-nhat-chuc-vu": require "portable/suachucvu.php";
					  		break;
						case "xoa-chuc-vu": require "portable/xoachucvu.php";
					  		break;	
						case "dslcv": require "portable/dsloaivanban.php";
					  		break;
						case "them-loai-cong-van": require "portable/themloaivanban.php";
					  		break;
						case "cap-nhat-loai-cong-van": require "portable/sualoaivanban.php";
					  		break;
						case "xoa-loai-cong-van": require "portable/xoaloaivanban.php";
					  		break;	
						case "goback": require "portable/goback.php";
					  		break;
						case "van-ban-noi-bo": require "portable/dsvanbannoibo.php";
					  		break;
						case "them-van-ban-noi-bo": require "portable/themvanbannoibo.php";
					  		break;
						case "chi-tiet-van-ban-noi-bo": require "portable/chitietvanbannoibo.php";
					  		break;
						case "xoa-van-ban-noi-bo": require "portable/xoavanbannoibo.php";
					  		break;
						case "cap-nhat-van-ban-noi-bo": require "portable/suavanbannoibo.php";
					  		break;
						case "van-ban-den": require "portable/dsvanbanden.php";
					  		break;
						case "them-van-ban-den": require "portable/themvanbanden.php";
					  		break;
						case "cap-nhat-van-ban-den": require "portable/suavanbanden.php";
					  		break;
						case "chi-tiet-van-ban-den": require "portable/chitietvanbanden.php";
					  		break;
						case "xoa-van-ban-den": require "portable/xoavanbanden.php";
					  		break;
						case "van-ban-di": require "portable/dsvanbandi.php";
					  		break;
						case "chi-tiet-van-ban-di": require "portable/chitietvanbandi.php";
					  		break;
						case "them-van-ban-di": require "portable/themvanbandi.php";
					  		break;
						case "xoa-van-ban-di": require "portable/xoavanbandi.php";
					  		break;	
						case "cap-nhat-van-ban-di": require "portable/suavanbandi.php";
					  		break;
						case "bao-cao": require "portable/baocao.php";
					  		break;
						case "bao-cao-vbnb": require "portable/bcvanbannoibo.php";
					  		break;
						case "bao-cao-vbden": require "portable/bcvanbanden.php";
					  		break;
						case "bao-cao-vbdi": require "portable/bcvanbandi.php";
					  		break;
						
                        default: require "portable/dsvanbannoibo.php";
                           break;
                  }
            ?>
     
</div>
<div style="margin-top:10px; border-radius: 30px 30px 0 0;">
<div style="margin-left:20px; width:1000px; margin:0 auto;">
<?php require "blocks/footer.php"; ?></div>
     <div class="page_danhmuc_clear"></div>
</div>
</div>
</body>
</html>