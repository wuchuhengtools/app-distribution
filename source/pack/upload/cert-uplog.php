<?php
include '../../system/db.class.php';
if(!empty($_FILES)){
	$filepart = pathinfo($_FILES['file']['name']);
	$extension = strtolower($filepart['extension']);
	if($extension == 'mobileprovision'){
		$json = json_decode(stripslashes($_POST['post']), true);
		$time = $json['_time'];
		$aid = intval($json['_aid']);
		$apw = $json['_apw'];
		if(!getfield('admin', 'in_adminid', 'in_adminid', $aid) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', $aid)) !== $apw){
			exit('-2');
		}
		$path = '../../../data/tmp/'.$time.'/';
        	creatdir($path);
		$dir = basename($_FILES['file']['name'], '.mobileprovision');
		$file = $path.$dir.'.mobileprovision';
		@move_uploaded_file($_FILES['file']['tmp_name'], $file);
		$mp = @file_get_contents($file);
		$iden = preg_match('/<key>application-identifier<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $mp, $m) ? $m[2] : NULL;
		$name = preg_match('/<key>TeamName<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $mp, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : NULL;
		$pl = @file_get_contents('../../../static/app/cert.plist');
		$pl = str_replace(array('[iden]', "\r"), array($iden, ''), $pl);
		@fwrite(fopen($path.$dir.'.plist', 'w'), $pl);
		$sh = @file_get_contents('../../../static/app/cert.sh');
		$sh = str_replace(array('[name]', '[cert]', "\r"), array($name, $dir, ''), $sh);
		@fwrite(fopen($path.$dir.'.sh', 'w'), $sh);
		include_once '../zip/zip.php';
		$zip = new PclZip('../../../data/cert/'.$dir.'.zip');
		if($zip->create($path, PCLZIP_OPT_REMOVE_PATH, $path)){
	 		echo "{'iden':'$iden','name':'$name','dir':'$dir'}";
		}
	}else{
	 	echo '-1';
	}
}
?>