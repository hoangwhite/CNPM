<?php
@session_start();
if(!isset($_SESSION["MaNSD"])){
	header ("location:index.php?active=home&pages=dang-nhap");
}
/*
	Su dung:
		basic:  ./download_test.php?f=file_name.xxx
		rename:  ./download_test.php?f=file_name.xxx&fc=new_file_name
	
	*auto tim file trong các subfolder nen chi can post ten_file.extension.
	*ten file moi khong can post extension.
*/

ob_start();
// base folder
$base_path ='../upload/vanbandi/';

define('BASE_DIR',$base_path);

// Allowed extensions list in format 'extension' => 'mime type'
// If myme type is set to empty string then script will try to detect mime type 
// itself, which would only work if you have Mimetype or Fileinfo extensions
// installed on server.
$allowed_ext = array (

  // archives
  'zip' => 'application/zip',

  // documents
  'pdf' => 'application/pdf',
  'doc' => 'application/msword',
  'xls' => 'application/vnd.ms-excel',
  'ppt' => 'application/vnd.ms-powerpoint',
  
  // executables
  'exe' => 'application/octet-stream',
  'wmv' => 'application/octet-stream',

  // images
  'gif' => 'image/gif',
  'png' => 'image/png',
  'jpg' => 'image/jpeg',
  'jpeg' => 'image/jpeg',

  // audio
  'mp3' => 'audio/mpeg',
  'wav' => 'audio/x-wav',
  'wma' => 'audio/x-ms-wma',

  // video
  'mpeg' => 'video/mpeg',
  'mpg' => 'video/mpeg',
  'mpe' => 'video/mpeg',
  'mov' => 'video/quicktime',
  'avi' => 'video/x-msvideo',
);



####################################################################
###  DO NOT CHANGE BELOW
####################################################################

// Make sure program execution doesn't time out
// Set maximum script execution time in seconds (0 means no limit)
set_time_limit(0);

if (!isset($_GET['files']) || empty($_GET['files'])) {
  die("Please specify file name for download.");
}

// Get real file name.
// Remove any path info to avoid hacking by adding relative path, etc.
$fname = basename($_GET['files']);

// Check if the file exists
// Check in subfolders too
function find_file ($dirname, $fname, &$file_path) {

  $dir = opendir($dirname);

  while ($file = readdir($dir)) {
    if (empty($file_path) && $file != '.' && $file != '..') {
      if (is_dir($dirname.'/'.$file)) {
        find_file($dirname.'/'.$file, $fname, $file_path);
      }
      else {
        if (file_exists($dirname.'/'.$fname)) {
          $file_path = $dirname.'/'.$fname;
          return;
        }
      }
    }
  }

} // find_file

// sub folder
$file_path = '';

find_file(BASE_DIR, $fname, $file_path);

if (!is_file($file_path)) {
  die("File does not exist. Make sure you specified correct file name."); 
}

// file size in bytes
$fsize = filesize($file_path); 

// file extension
$fext = strtolower(substr(strrchr($fname,"."),1));

// check if allowed extension
if (!array_key_exists($fext, $allowed_ext)) {
  die("Not allowed file type."); 
}

// get mime type
if ($allowed_ext[$fext] == '') {
  $mtype = '';
  // mime type is not set, get from server settings
  if (function_exists('mime_content_type')) {
    $mtype = mime_content_type($file_path);
  }
  else if (function_exists('finfo_file')) {
    $finfo = finfo_open(FILEINFO_MIME); // return mime type
    $mtype = finfo_file($finfo, $file_path);
    finfo_close($finfo);  
  }
  if ($mtype == '') {
    $mtype = "application/force-download";
  }
}
else {
  // get mime type defined by admin
  $mtype = $allowed_ext[$fext];
}

// Browser will try to save file with this filename, regardless original filename.
// You can override it if needed.

if (!isset($_GET['fc']) || empty($_GET['fc'])) {
  $asfname = $fname;
}
else {
  // remove some bad chars
  $asfname = str_replace(array('"',"'",'\\','/'), '', $_GET['fc']).".".$fext;
  if ($asfname === '') $asfname = 'NoName';
}

// set headers
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-rlevelidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/force-download"); 
header("Content-Type: $mtype");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=".$asfname);
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

// download
// @readfile($file_path);
$file = @fopen($file_path,"rb");
if ($file) {
  while(!feof($file)) {
    print(fread($file, 1024*8));
    flush();
    if (connection_status()!=0) {
      @fclose($file);
      die();
    }
  }
  @fclose($file);
}

ob_end_flush();
?>