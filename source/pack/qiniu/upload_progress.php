<?php

require_once '../../system/db.class.php';
require_once 'autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
$auth = new Auth(IN_REMOTEAK, IN_REMOTESK);
$token = $auth->uploadToken(IN_REMOTEBK);
$bucketMgr = new BucketManager($auth);
$uploadMgr = new UploadManager();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<title>七牛云存储</title>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/remote.js"></script>
<script type="text/javascript">set_start();</script>
</head>
<body>
<?php

ob_start();
@set_time_limit(0);
function callback($resource){
        $info = curl_getinfo($resource);
        echo '<script type="text/javascript">set_progress('.$info['size_upload'].', '.$info['upload_content_length'].');</script>';
        ob_flush();
        flush();
}
if($_GET['ac'] == 'icon'){
        $id = intval($_GET['id']);
        $uid = intval($_GET['uid']);
        $upw = SafeSql($_GET['upw']);
        $userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
        $row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
        $row or exit('<script type="text/javascript">set_error("应用不存在或已被删除！");</script>');
        $row['in_uid'] == $userid or exit('<script type="text/javascript">set_error("您不能更新别人的应用！");</script>');
        $dst = '../../../data/attachment/'.$row['in_icon'];
        $object = $row['in_icon'];
        $bucketMgr->delete(IN_REMOTEBK, $object);
        $uploadMgr->putFile($token, $object, $dst);
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$id);
        echo '<script type="text/javascript">set_reload();</script>';
}elseif($_GET['ac'] == 'app'){
        $time = SafeSql($_GET['time']);
        $uid = intval($_GET['uid']);
        $upw = SafeSql($_GET['upw']);
        $userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
        $row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_icon='".$time.".png'");
        $row or exit('<script type="text/javascript">set_error("应用不存在或已被删除！");</script>');
        $row['in_uid'] == $userid or exit('<script type="text/javascript">set_error("您不能更新别人的应用！");</script>');
        $ext = $row['in_form'] == 'Android' ? '.apk' : '.ipa';
        $dst = '../../../data/attachment/'.$time.'.png';
        $object = $time.'.png';
        $uploadMgr->putFile($token, $object, $dst);
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
        $dst = '../../../data/attachment/'.$time.$ext;
        $object = $time.$ext;
        $uploadMgr->putFile($token, $object, $dst);
        if($ext == '.ipa'){
                $url = 'https://'.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/';
                $plist = '../../../data/attachment/'.$time.'.plist';
                $str = file_get_contents($plist);
                $str = str_replace($url, IN_REMOTEDK, $str);
                fwrite(fopen($plist, 'w'), $str);
                $object = $time.'.plist';
                $uploadMgr->putFile($token, $object, $plist);
                @unlink($plist);
                $ssl = str_replace('http://', 'https://', IN_REMOTEDK).$object;
        }else{
                $ssl = IN_REMOTEDK.$object;
        }
        @unlink($dst);
        $GLOBALS['db']->query("update ".tname('app')." set in_plist='$ssl' where in_id=".$row['in_id']);
        echo '<script type="text/javascript">set_reload();</script>';
}
?>
</body>
</html>