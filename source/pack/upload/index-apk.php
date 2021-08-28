<?php
include '../../system/db.class.php';
include '../../system/user.php';
include 'deapk/examples/autoload.php';
error_reporting(0);
$GLOBALS['userlogined'] or exit('-1');
$id = intval($_GET['id']);
$time = $_GET['time'];
$xml_size = formatsize($_GET['size']);
$tmp = '../../../data/tmp/'.$time.'.apk';
$dir = '../../../data/attachment/'.$time;
is_file($dir.'.apk') and exit('-2');
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
if($id){
	getfield('app', 'in_bid', 'in_id', $id) == $xml_bid or exit('-3');
}else{
	$id = $GLOBALS['db']->getone("select in_id from ".tname('app')." where in_bid='$xml_bid' and in_form='Android' and in_uid=".$GLOBALS['erduo_in_userid']);
}
foreach($resources as $resource){
        fwrite(fopen($dir.'.png', 'w'), stream_get_contents($apk->getStream($resource)));
}
rename($tmp, $dir.'.apk');
$xml_plist = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/'.$time.'.apk';
if($id){
	$del_icon = $GLOBALS['db']->getone("select in_icon from ".tname('app')." where in_id=$id and in_uid=".$GLOBALS['erduo_in_userid']);
	$del = '../../../data/attachment/'.$del_icon;
	@unlink($del);
	@unlink(str_replace('.png', '.plist', $del));
	@unlink(str_replace('.png', '.ipa', $del));
	@unlink(str_replace('.png', '.apk', $del));
	$GLOBALS['db']->query("update ".tname('app')." set in_name='$xml_name',in_type=0,in_size='$xml_size',in_form='Android',in_mnvs='$xml_mnvs',in_bid='$xml_bid',in_bsvs='$xml_bsvs',in_bvs='$xml_bvs',in_nick='*',in_team='*',in_icon='".$time.".png',in_plist='$xml_plist',in_addtime='".date('Y-m-d H:i:s')."' where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
}else{
	$GLOBALS['db']->query("Insert ".tname('app')." (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_plist,in_hits,in_kid,in_sign,in_resign,in_addtime) values ('$xml_name',".$GLOBALS['erduo_in_userid'].",'".$GLOBALS['erduo_in_username']."',0,'$xml_size','Android','$xml_mnvs','$xml_bid','$xml_bsvs','$xml_bvs','*','*','".$time.".png','$xml_plist',0,0,0,0,'".date('Y-m-d H:i:s')."')");
}
echo '1';
?>