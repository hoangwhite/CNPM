<?php 
class Upload{ 
    // Bien luu tru ten tap tin upload 
    var $_fileName; 
    
    //Bien luu tru kich thuoc cua tap tin upload 
    var $_fileSize; 
     
    //Bien luu tru phan mo rong cua tap tin upload 
    var $_fileExtension; 
     
    //Bien luu tru duong dan cua thu muc tam tap tin upload 
    var $_fileTmp; 
     
    //Bien luu tru duong tren server cua tap tin upload 
    var $_uploadDir; 
     
    //Bien luu tru error  
    var $_errors; 
	
	var $file_renames;
     
    //Ham khoi tao doi tuong 
    function __construct($file_name){ 
      
        $fileInfo =  $_FILES[$file_name]; 
        $this->_fileName = $fileInfo['name']; 
        $this->_fileSize = $fileInfo['size']; 
        $this->_fileExtension = $this->getFileExtension(); 
        $this->_fileTmp = $fileInfo['tmp_name']; 
         
    } 
     
    //Ham lay thanh phan mo rong cua tap tin upload 
    function getFileExtension(){ 
        $subject = $this->_fileName;     
        $pattern = '#\.([^\.]+)$#i';     
        preg_match($pattern,$subject,$matches); 
        return $matches[1]; 
    } 
     
    //Ham thiet lap thanh phan mo rong tap tin upload 
    function setFileExtension($value){ 
        $subject = $this->_fileExtension;     
        $pattern = '#(' . $value . ')#i';     
        if(preg_match($pattern,$subject,$matches)!= 1){ 
            $this->_errors[] = 'Phan mo rong khong phu hop'; 
        } 
    } 
	
     
    //Ham thiet lap kich thuoc tap tin upload 
    function setFileSize($value){ 
        $size = $value * 1024; 
        if($this->_fileSize > $size){ 
            $this->_errors[] = 'Kich thuoc tap tin lon hon ' . $size . 'kb'; 
        }     
    } 
     
    //Ham thiet lap kich thuoc tap tin upload 
    function setUploadDir($value){ 
        if(file_exists($value)){ 
            $this->_uploadDir = $value; 
        }else{ 
            $this->_errors[] = 'Thu muc khong he ton tai'; 
        } 
    } 
     
    //Ham kiem tra dieu kien upload 
    function isVail(){ 
        $flagErr = false; 
        if(count($this->_errors)>0){ 
            $flagErr =  true; 
        } 
         
        return $flagErr; 
    } 
     
    //Ham upload tap tin 
    function upload($rename =  false, $prefix = 'file_'){ 
        if($rename ==  false){ 
            $source = $this->_fileTmp; 
            $dect = $this->_uploadDir . $this->_fileName; 
        }else{ 
            $source = $this->_fileTmp; 
            $dect = $this->_uploadDir . $prefix . time() . '.' . $this->_fileExtension; 
        } 
        copy($source,$dect); 
    } 
	function upload_file($rename =  false, $prefix = 'file_')
	{
		if($rename ==  false){ 
            $source = $this->_fileTmp; 
            $dect = $this->_uploadDir . $this->_fileName; 
        }else{ 
            $source = $this->_fileTmp; 
            $this->file_renames = $prefix . time() . '.' . $this->_fileExtension; 
        } 
	}
}

?>