<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$id = intval(SafeRequest("id","get"));
$step = SafeRequest("step","get");
$percent = intval(SafeRequest("percent","get"));
$pw = SafeRequest("pw","get");
$pw == IN_SECRET or exit('Access denied');
updatetable('signlog', array('in_step' => $step,'in_percent' => $percent), array('in_aid' => $id));
?>