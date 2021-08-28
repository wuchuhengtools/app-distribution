<?php
include '../system/db.class.php';
include '../system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
$GLOBALS['userlogined'] or exit('-1');
$ac = SafeRequest("ac","get");
if($ac == 'purchase'){
	$aid = intval(SafeRequest("aid","get"));
	$key = SafeRequest("key","get");
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$aid);
	$row or exit('-2');
	$tid = $GLOBALS['db']->getone("select in_tid from ".tname('key')." where in_state=0 and in_code='$key'");
	$tid or exit('-3');
	updatetable('key', array('in_state' => 1), array('in_code' => $key));
	$stamp = $tid > 1 ? $tid > 2 ? 32140800 : 8035200 : 2678400;
	$time = $row['in_sign'] ? $row['in_sign'] + $stamp : time() + $stamp;
	updatetable('app', array('in_sign' => $time), array('in_id' => $aid));
	$GLOBALS['db']->query("update ".tname('app')." set in_resign=in_resign+".IN_RESIGN." where in_id=".$aid);
	echo '1';
}elseif($ac == 'listen'){
	$aid = intval(SafeRequest("aid","get"));
	$row = $GLOBALS['db']->getrow("select * from ".tname('signlog')." where in_aid=".$aid);
	echo "{'status':'".$row['in_status']."','step':'".$row['in_step']."','percent':'".$row['in_percent']."'}";
}elseif($ac == 'sign'){
	$aid = intval(SafeRequest("aid","get"));
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$aid);
	$row or exit('-2');
	$row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
	$row['in_form'] == 'iOS' or exit('-4');
	$row['in_sign'] > 0 or exit('-5');
	$row['in_resign'] > 0 or exit('-6');
	$status = $GLOBALS['db']->getone("select in_status from ".tname('signlog')." where in_aid=".$aid);
	$status and $status == 1 and exit('-7');
	empty($_GET['check']) or exit('1');
	$setarr = array(
		'in_aid' => $row['in_id'],
		'in_aname' => $row['in_name'],
		'in_uid' => $GLOBALS['erduo_in_userid'],
		'in_uname' => $GLOBALS['erduo_in_username'],
		'in_status' => 1,
		'in_step' => 'unknown',
		'in_percent' => 0,
		'in_addtime' => date('Y-m-d H:i:s')
	);
	if($status){
		updatetable('signlog', $setarr, array('in_aid' => $aid));
		$GLOBALS['db']->query("update ".tname('app')." set in_resign=in_resign-1 where in_id=".$aid);
	}else{
		inserttable('signlog', $setarr);
	}
	echo '1';
}
?>