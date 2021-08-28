<?php

require_once '../../system/db.class.php';
require_once 'samples/Common.php';
use OSS\OssClient;
use OSS\Core\OssException;
$bucket = Common::getBucketName();
@set_time_limit(0);
if($_GET['ac'] == 'icon'){
        $id = intval($_GET['id']);
        $uid = intval($_GET['uid']);
        $upw = SafeSql($_GET['upw']);
        $userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
        $row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
        $row or exit('-1');
        $row['in_uid'] == $userid or exit('-2');
        $dst = '../../../data/attachment/'.$row['in_icon'];
        $object = $row['in_icon'];
        $ossClient = Common::getOssClient();
        $ossClient->uploadFile($bucket, $object, $dst);
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$id);
        echo '1';
}elseif($_GET['ac'] == 'app'){
        $time = SafeSql($_GET['time']);
        $uid = intval($_GET['uid']);
        $upw = SafeSql($_GET['upw']);
        $userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
        $row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_icon='".$time.".png'");
        $row or exit('-1');
        $row['in_uid'] == $userid or exit('-2');
        $ext = $row['in_form'] == 'Android' ? '.apk' : '.ipa';
        $dst = '../../../data/attachment/'.$time.'.png';
        $object = $time.'.png';
        $ossClient = Common::getOssClient();
        $ossClient->uploadFile($bucket, $object, $dst);
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
        $dst = '../../../data/attachment/'.$time.$ext;
        $object = $time.$ext;
        $ossClient = Common::getOssClient();
        $ossClient->uploadFile($bucket, $object, $dst);
        if($ext == '.ipa'){
                $url = 'https://'.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/';
                $plist = '../../../data/attachment/'.$time.'.plist';
                $str = file_get_contents($plist);
                $str = str_replace($url, IN_REMOTEDK, $str);
                fwrite(fopen($plist, 'w'), $str);
                $object = $time.'.plist';
                $ossClient = Common::getOssClient();
                $ossClient->uploadFile($bucket, $object, $plist);
                @unlink($plist);
                $ssl = str_replace('http://', 'https://', IN_REMOTEDK).$object;
        }else{
                $ssl = IN_REMOTEDK.$object;
        }
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_plist='$ssl' where in_id=".$row['in_id']);
        echo '1';
}
?>