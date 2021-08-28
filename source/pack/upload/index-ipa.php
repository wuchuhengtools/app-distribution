<?php
namespace PngFile;
require_once 'depng/pngCompote.php';
namespace CFPropertyList;
require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
include '../../system/user.php';
error_reporting(0);
$GLOBALS['userlogined'] or exit('-1');
$id = intval($_GET['id']);
$time = $_GET['time'];
$size = $_GET['size'];
$tmp = '../../../data/tmp/'.$time.'.ipa';
$path = '../../../data/attachment/'.$time;
is_file($path.'.ipa') and exit('-2');
$dir = '../../../data/tmp/'.$time.'/Payload';
if(is_dir($dir)){
        $d = NULL;
        $h = opendir($dir);
        while($f = readdir($h)){
                if($f != '.' && $f != '..' && is_dir($dir.'/'.$f)){
                        $d = $dir.'/'.$f;
                }
        }
        closedir($h);
        $info = file_get_contents($d.'/Info.plist');
        $plist = new CFPropertyList();
        $plist->parse($info);
        $plist = $plist->toArray();
        $xml_size = formatsize($size);
        $xml_name = detect_encoding(isset($plist['CFBundleDisplayName']) ? $plist['CFBundleDisplayName'] : $plist['CFBundleName']);
        $xml_mnvs = $plist['MinimumOSVersion'];
        $xml_bid = $plist['CFBundleIdentifier'];
        $xml_bsvs = $plist['CFBundleShortVersionString'];
        $xml_bvs = $plist['CFBundleVersion'];
        if($id){
	        getfield('app', 'in_bid', 'in_id', $id) == $xml_bid or exit('-3');
        }else{
	        $id = $GLOBALS['db']->getone("select in_id from ".tname('app')." where in_bid='$xml_bid' and in_form='iOS' and in_uid=".$GLOBALS['erduo_in_userid']);
        }
        rename($tmp, $path.'.ipa');
        $newfile = $path.'.png';
        $icon = $plist['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles'];
        if(!$icon){
		$icon = $plist['CFBundleIconFiles'];
		if(!$icon){
			$icon = $plist['CFBundleIconFiles~ipad'];
		}
        }
        if(preg_match('/\./', $icon[0])){
		$cvt = is_file($d.'/'.$icon[0]) ? 'trim' : 'strtolower';
		for($i = 0; $i < count($icon); $i++){
			if(is_file($d.'/'.$cvt($icon[$i]))){
				$big[] = filesize($d.'/'.$cvt($icon[$i]));
				$small[] = filesize($d.'/'.$cvt($icon[$i]));
			}
		}
		rsort($big);
		sort($small);
		for($p = 0; $p < count($icon); $p++){
			if($big[0] == filesize($d.'/'.$cvt($icon[$p]))){
                		$bigfile = $d.'/'.$cvt($icon[$p]);
			}
			if($small[0] == filesize($d.'/'.$cvt($icon[$p]))){
                		$smallfile = $d.'/'.$cvt($icon[$p]);
			}
		}
        }else{
		$ext = is_file($d.'/'.$icon[0].'.png') ? '.png' : '@2x.png';
		for($i = 0; $i < count($icon); $i++){
			if(is_file($d.'/'.$icon[$i].$ext)){
				$big[] = filesize($d.'/'.$icon[$i].$ext);
				$small[] = filesize($d.'/'.$icon[$i].$ext);
			}
		}
		rsort($big);
		sort($small);
		for($p = 0; $p < count($icon); $p++){
			if($big[0] == filesize($d.'/'.$icon[$p].$ext)){
                		$bigfile = is_file($d.'/'.$icon[$p].'@3x.png') ? $d.'/'.$icon[$p].'@3x.png' : $d.'/'.$icon[$p].$ext;
			}
			if($small[0] == filesize($d.'/'.$icon[$p].$ext)){
                		$smallfile = preg_match('/AppIcon20x20/', $icon[$p]) ? $d.'/'.$icon[$p].'@3x.png' : $d.'/'.$icon[$p].$ext;
			}
		}
        }
        $png = new \PngFile\PngFile($smallfile);
        if(!$png->revertIphone($newfile)){
		if(!rename($bigfile, $newfile)){
		        if($plist['CFBundleIconFile']){
                		if(preg_match('/\./', $plist['CFBundleIconFile'])){
                			rename($d.'/'.$plist['CFBundleIconFile'], $newfile);
                		}else{
                			rename($d.'/'.$plist['CFBundleIconFile'].'.png', $newfile);
                		}
		        }else{
                		copy('../../../static/app/iOS.png', $newfile);
		        }
		}
        }
        $xml_icon = $time.'.png';
        $em = file_get_contents($d.'/embedded.mobileprovision');
        $xml_form = preg_match('/<key>Platform<\/key>([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? $m[2] : 'iOS';
        $xml_nick = preg_match('/<key>Name<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : '*';
        $xml_type = preg_match('/^iOS Team Provisioning Profile:/', $xml_nick) ? 0 : 1;
        $xml_team = preg_match('/<key>TeamName<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : '*';
        $url = 'https://'.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/'.$time;
	$str = file_get_contents('../../../static/app/down.plist');
	$str = str_replace(array('{ipa}', '{icon}', '{bid}', '{name}'), array($url.'.ipa', $url.'.png', $xml_bid, $xml_name), $str);
	fwrite(fopen($path.'.plist', 'w'), convert_charset($str));
        $xml_plist = $url.'.plist';
        if($id){
		$del_icon = $GLOBALS['db']->getone("select in_icon from ".tname('app')." where in_id=$id and in_uid=".$GLOBALS['erduo_in_userid']);
		$del = '../../../data/attachment/'.$del_icon;
		@unlink($del);
		@unlink(str_replace('.png', '.plist', $del));
		@unlink(str_replace('.png', '.ipa', $del));
		@unlink(str_replace('.png', '.apk', $del));
		$GLOBALS['db']->query("update ".tname('app')." set in_name='$xml_name',in_type=$xml_type,in_size='$xml_size',in_form='$xml_form',in_mnvs='$xml_mnvs',in_bid='$xml_bid',in_bsvs='$xml_bsvs',in_bvs='$xml_bvs',in_nick='$xml_nick',in_team='$xml_team',in_icon='$xml_icon',in_plist='$xml_plist',in_addtime='".date('Y-m-d H:i:s')."' where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
        }else{
		$GLOBALS['db']->query("Insert ".tname('app')." (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_plist,in_hits,in_kid,in_sign,in_resign,in_addtime) values ('$xml_name',".$GLOBALS['erduo_in_userid'].",'".$GLOBALS['erduo_in_username']."',$xml_type,'$xml_size','$xml_form','$xml_mnvs','$xml_bid','$xml_bsvs','$xml_bvs','$xml_nick','$xml_team','$xml_icon','$xml_plist',0,0,0,0,'".date('Y-m-d H:i:s')."')");
        }
	echo '1';
}
?>