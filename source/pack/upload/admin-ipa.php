<?php
namespace PngFile;
require_once 'depng/pngCompote.php';
namespace CFPropertyList;
require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
error_reporting(0);
if(empty($_COOKIE['in_adminid']) || empty($_COOKIE['in_adminname']) || empty($_COOKIE['in_adminpassword']) || empty($_COOKIE['in_permission']) || empty($_COOKIE['in_adminexpire']) || !getfield('admin', 'in_adminid', 'in_adminid', intval($_COOKIE['in_adminid'])) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
	exit('-1');
}
$time = $_GET['time'];
$size = $_GET['size'];
$tmp = '../../../data/tmp/'.$time.'.ipa';
$path = '../../../data/attachment/'.$time;
$dir = '../../../data/tmp/'.$time.'/Payload';
if(is_dir($dir)){
        rename($tmp, $path.'.ipa');
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
	echo "{'name':'$xml_name','mnvs':'$xml_mnvs','bid':'$xml_bid','bsvs':'$xml_bsvs','bvs':'$xml_bvs','form':'$xml_form','nick':'$xml_nick','type':'$xml_type','team':'$xml_team','icon':'$xml_icon','plist':'$xml_plist','size':'$xml_size'}";
}
?>