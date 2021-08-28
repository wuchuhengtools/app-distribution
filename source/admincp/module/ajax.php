<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(1);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $update_api;
$ac=SafeRequest("ac","get");
if($ac == 'build'){
	$file='data/tmp/build.xml';
	creatdir(dirname($file));
	fwrite(fopen($file, 'w+'), @file_get_contents($update_api.'?auth=build'));
	if($xml = @simplexml_load_file($file)){
		$build=intval(trim($xml->item['build']));
		if($build > IN_BUILD){
			echo $build;
		}
	}
}
?>