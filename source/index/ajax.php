<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
session_start();
$ac = SafeRequest("ac","get");
if($ac == 'login'){
	$mail = SafeRequest("mail","get");
	$pwd = substr(md5(SafeRequest("pwd","get")),8,16);
	$row = $GLOBALS['db']->getrow("select * from ".tname('user')." where in_username='".$mail."' and in_userpassword='".$pwd."'");
	if($row){
		if($row['in_islock'] == 1){
		        echo 'return_1';
		}else{
		        if($GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=".$row['in_userid']." and DATEDIFF(DATE(in_logintime),'".date('Y-m-d')."')=0")){
		        	$GLOBALS['db']->query("update ".tname('user')." set in_loginip='".getonlineip()."',in_logintime='".date('Y-m-d H:i:s')."' where in_userid=".$row['in_userid']);
		        }else{
		        	$GLOBALS['db']->query("update ".tname('user')." set in_points=in_points+".IN_LOGINPOINTS.",in_loginip='".getonlineip()."',in_logintime='".date('Y-m-d H:i:s')."' where in_userid=".$row['in_userid']);
		        }
		        setcookie('in_userid', $row['in_userid'], time() + 86400, IN_PATH);
		        setcookie('in_username', $mail, time() + 86400, IN_PATH);
		        setcookie('in_userpassword', $pwd, time() + 86400, IN_PATH);
		        echo 'return_3';
		}
	}else{
		echo 'return_2';
	}
}elseif($ac == 'reg'){
	$mail = SafeRequest("mail","get");
	$pwd = substr(md5(SafeRequest("pwd","get")),8,16);
	$seccode = SafeRequest("seccode","get");
	if($seccode != $_SESSION['code']){
		echo 'return_1';
	}elseif($GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_username='".$mail."'")){
		echo 'return_2';
	}else{
	        $setarr = array(
		        'in_username' => $mail,
		        'in_userpassword' => $pwd,
		        'in_regdate' => date('Y-m-d H:i:s'),
		        'in_loginip' => getonlineip(),
		        'in_logintime' => date('Y-m-d H:i:s'),
		        'in_islock' => 0,
		        'in_points' => IN_LOGINPOINTS
	        );
	        $in_userid = inserttable('user', $setarr, 1);
		setcookie('in_userid', $in_userid, time() + 86400, IN_PATH);
		setcookie('in_username', $mail, time() + 86400, IN_PATH);
		setcookie('in_userpassword', $pwd, time() + 86400, IN_PATH);
		echo 'return_3';
	}
}elseif($ac == 'send'){
        IN_MAILOPEN == 0 and exit('return_0');
	$mail = SafeRequest("mail","get");
	$uid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_username='".$mail."'");
        $uid or exit('return_1');
	$mcode = md5(time().rand(2,pow(2,24)));
	$cookie = 'in_send_mail';
	empty($_COOKIE[$cookie]) or exit('return_2');
	setcookie($cookie, 'have', time() + 30, IN_PATH);
	$ssl = is_ssl() ? 'https://' : 'http://';
	include_once '../pack/mail/mail.php';
	$email = new PHPMailer();
	$email->IsSMTP();
	$email->CharSet = 'utf-8';
	$email->SMTPAuth = true;
	$email->Host = IN_MAILSMTP;
	$email->Username = IN_MAIL;
	$email->Password = IN_MAILPW;
	$email->From = IN_MAIL;
	$email->FromName = convert_charset(IN_NAME);
	$email->Subject = convert_charset('['.$mail.']�һ������ʼ�');
	$email->AddAddress($mail, $mail);
	$html = '�һ�������ʼ���Ϊ��'.$mcode.'�������ʼ���Ϊ�����������ã��뾡��ʹ�ã�<br />��Ǳ��˲���������Դ��ʼ���<br /><br />'.$ssl.$_SERVER['HTTP_HOST'].IN_PATH;
	$email->MsgHTML(convert_charset($html));
	$email->IsHTML(true);
	if(!$email->Send()){
		echo 'return_3';
	}else{
		$setarr = array(
			'in_uid' => $uid,
			'in_ucode' => $mail.$mcode,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('mail', $setarr, 1);
		echo 'return_4';
	}
}elseif($ac == 'lost'){
	$mail = SafeRequest("mail","get");
	$pwd = substr(md5(SafeRequest("pwd","get")),8,16);
	$mcode = SafeRequest("mcode","get");
	$uid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_username='".$mail."'");
        $uid or exit('return_1');
	$mid = $GLOBALS['db']->getone("select in_id from ".tname('mail')." where in_uid=".$uid." and in_ucode='".$mail.$mcode."'");
        $mid or exit('return_2');
	$GLOBALS['db']->query("delete from ".tname('mail')." where in_id=".$mid);
	updatetable('user', array('in_userpassword' => $pwd), array('in_userid' => $uid));
	echo 'return_3';
}
?>