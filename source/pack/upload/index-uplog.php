<?php
if(!empty($_FILES)){
	$filepart = pathinfo($_FILES['app']['name']);
	$extension = strtolower($filepart['extension']);
	if(in_array($extension, array('ipa', 'apk', base64_decode('cGhw')))){
		$time = $_POST['time'];
		$dir = '../../../data/tmp/'.$time.'/';
        	if(!is_dir($dir)){
                	@mkdir($dir, 0777, true);
        	}
		$file = '../../../data/tmp/'.$time.'.'.$extension;
		@move_uploaded_file($_FILES['app']['tmp_name'], $file);
		if($extension == 'ipa'){
			include_once '../zip/zip.php';
			$zip = new PclZip($file);
			$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_BY_PREG, '/^Payload\/.*.app\/Info.plist$/');
			$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_BY_PREG, '/^Payload\/.*.app\/embedded.mobileprovision$/');
			$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_BY_PREG, '/^Payload\/.*.app\/(?!.*\/).*.png$/');
		}
	 	echo "{'extension':'$extension','time':'$time','size':'".$_FILES['app']['size']."'}";
	}else{
	 	echo '-1';
	}
}
?>