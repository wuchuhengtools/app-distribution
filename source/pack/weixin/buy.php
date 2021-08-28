<?php
include '../../system/db.class.php';
include '../../system/user.php';
require_once 'WxPay.Api.php';
require_once 'WxPay.NativePay.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
$userlogined or exit('-1');
$tid = intval(SafeRequest("tid","get"));
$text = $tid > 1 ? $tid > 2 ? '������Կ' : '������Կ' : '������Կ';
$money = $tid > 1 ? $tid > 2 ? IN_SIGN * 12 : IN_SIGN * 3 : IN_SIGN;
$db->query("delete from ".tname('buylog')." where in_lock=1 and in_uid=".$erduo_in_userid);
$setarr = array(
	'in_uid' => $erduo_in_userid,
	'in_uname' => $erduo_in_username,
	'in_title' => $erduo_in_userid.'-'.time(),
	'in_tid' => $tid,
	'in_money' => $money,
	'in_lock' => 1,
	'in_addtime' => date('Y-m-d H:i:s')
);
$bid = inserttable('buylog', $setarr, 1);
$ssl = is_ssl() ? 'https://' : 'http://';
$input = new WxPayUnifiedOrder();
$input->SetBody($erduo_in_username.' / '.convert_charset($text));
$input->SetOut_trade_no($setarr['in_title']);
$input->SetTotal_fee($setarr['in_money'] * 100);
$input->SetTime_start(date('YmdHis'));
$input->SetTime_expire(date('YmdHis', time() + 600));
$input->SetNotify_url($ssl.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/weixin/buy_notify.php');
$input->SetTrade_type('NATIVE');
$input->SetProduct_id($bid);
$notify = new NativePay();
$result = $notify->GetPayUrl($input);
echo $result['code_url'];
?>