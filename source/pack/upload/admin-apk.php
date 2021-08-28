<?php
include '../../system/db.class.php';
include 'deapk/examples/autoload.php';
error_reporting(0);
if(empty($_COOKIE['in_adminid']) || empty($_COOKIE['in_adminname']) || empty($_COOKIE['in_adminpassword']) || empty($_COOKIE['in_permission']) || empty($_COOKIE['in_adminexpire']) || !getfield('admin', 'in_adminid', 'in_adminid', intval($_COOKIE['in_adminid'])) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
	exit('-1');
}
$time = $_GET['time'];
$xml_size = formatsize($_GET['size']);
$tmp = '../../../data/tmp/'.$time.'.apk';
$dir = '../../../data/attachment/'.$time;
$apk = new \ApkParser\Parser($tmp);
$xml_mnvs = $apk->getManifest()->getMinSdkLevel();
$xml_bid = $apk->getManifest()->getPackageName();
$xml_bsvs = $apk->getManifest()->getVersionName();
$xml_bvs = $apk->getManifest()->getVersionCode();
$labelResourceId = $apk->getManifest()->getApplication()->getLabel();
$appLabel = $apk->getResources($labelResourceId);
$xml_name = detect_encoding($appLabel[0]);
$resourceId = $apk->getManifest()->getApplication()->getIcon();
$resources = $apk->getResources($resourceId);
foreach($resources as $resource){
        fwrite(fopen($dir.'.png', 'w'), stream_get_contents($apk->getStream($resource)));
}
rename($tmp, $dir.'.apk');
$xml_plist = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/'.$time.'.apk';
echo "{'name':'$xml_name','mnvs':'$xml_mnvs','bid':'$xml_bid','bsvs':'$xml_bsvs','bvs':'$xml_bvs','form':'Android','nick':'*','type':'0','team':'*','icon':'".$time.".png','plist':'$xml_plist','size':'$xml_size'}";
?>