<?php
if(!defined('IN_ROOT')){exit('Access denied');}
$action=SafeRequest("action","get");
if($action=="login"){
	if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,0);}
	global $db;
	$adminname=SafeRequest("adminname","post");
	$adminpassword=md5(SafeRequest("adminpassword","post"));
	$code=SafeRequest("code","post");
	if(IN_CODEOPEN==1 && $code!==IN_CODE){
		ShowMessage("��֤�����������ԣ�",$_SERVER['PHP_SELF'],"infotitle3",2000,0);
	}
        $row=$db->getrow("select * from ".tname('admin')." where in_adminname='".$adminname."' and in_adminpassword='".$adminpassword."' and in_islock=0");
	if($row){
		$db->query("update ".tname('admin')." set in_loginnum=in_loginnum+1,in_loginip='".getonlineip()."',in_logintime='".date('Y-m-d H:i:s')."' where in_adminid=".$row['in_adminid']);
		setcookie("in_adminid",$row['in_adminid']);
		setcookie("in_adminname",$row['in_adminname']);
		setcookie("in_adminpassword",md5($row['in_adminpassword']));
		setcookie("in_permission",$row['in_permission']);
		setcookie("in_adminexpire","have",time()+1800);
		ShowMessage("��¼�ɹ�������ת��������ģ�","?iframe=index","infotitle2",1000,0);
	}else{
		ShowMessage("��¼��Ϣ������ʺ�δ��������ԣ�",$_SERVER['PHP_SELF'],"infotitle3",3000,0);
	}
}elseif($action=="logout"){
	setcookie("in_adminid","",time()-1);
	setcookie("in_adminname","",time()-1);
	setcookie("in_adminpassword","",time()-1);
	setcookie("in_permission","",time()-1);
	setcookie("in_adminexpire","",time()-1);
	ShowMessage("���Ѿ���ȫ�˳��������ģ�",$_SERVER['PHP_SELF'],"infotitle1",1000,0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>��¼��������</title>
<link rel="stylesheet" href="static/admincp/css/main.css" type="text/css" media="all" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function CheckLogin(){
	if(document.form.adminname.value==""){
	        asyncbox.tips("�û�������Ϊ�գ�����д��", "wait", 1000);
	        document.form.adminname.focus();
	        return false;
	}
	else if(document.form.adminpassword.value==""){
	        asyncbox.tips("���벻��Ϊ�գ�����д��", "wait", 1000);
	        document.form.adminpassword.focus();
	        return false;
	}
	<?php if(IN_CODEOPEN==1){ ?>
	else if(document.form.code.value==""){
	        asyncbox.tips("��֤�벻��Ϊ�գ�����д��", "wait", 1000);
	        document.form.code.focus();
	        return false;
	}
	<?php } ?>
	else {
	        return true;
	}
}
</script>
</head>
<body>
<table class="logintb">
<tr>
	<td class="login">
		<h1>Ear Music Administrator's Control Panel</h1>
		<p><a href="http://www.erduo.in" target="_blank">��������</a> �� <a href="http://www.earcms.com" target="_blank">����CMS</a> �Ƴ���һ��������Ϊ������PHP���ݹ���ϵͳ��������վʵ����������</p>
	</td>
	<td>	<form method="post" name="form" action="?action=login" target="_top">
		<p class="logintitle">�û���: </p>
		<p class="loginform"><input name="adminname" id="adminname" type="text" class="txt" /></p>
		<p class="logintitle">�ܡ���:</p>
		<p class="loginform"><input name="adminpassword" id="adminpassword" type="password" class="txt" /></p>
		<?php if(IN_CODEOPEN==1){ ?>
		<p class="logintitle">�ᡡ��:</p>
		<p class="loginform"><select><option value="��֤��">��֤��</option></select></p>
		<p class="logintitle">�ء���:</p>
		<p class="loginform"><input name="code" id="code" type="password" class="txt" /></p>
		<?php }else{ ?>
		<p class="logintitle">�ᡡ��:</p>
		<p class="loginform"><select><option value="�ް�ȫ����">�ް�ȫ����</option></select></p>
		<p class="logintitle">�⡡��:</p>
		<p class="loginform"><input class="txt" readonly="readonly" /></p>
		<?php } ?>
		<p class="loginnofloat"><input name="form" value="�ύ" type="submit" class="btn" onclick="return CheckLogin();" /></p>
		</form>
	</td>
</tr>
</table>
<table class="logintb">
<tr>
	<td colspan="2" class="footer">
		<div class="copyright">
			<p>Powered by <a href="http://www.erduo.in/" target="_blank">Ear Music</a> <?php echo IN_VERSION; ?> </p>
			<p>&copy; 2011-<?php echo date('Y'); ?>, <a href="http://www.earcms.com/" target="_blank">EarCMS</a> Inc.</p>
		</div>
	</td>
</tr>
</table>
</body>
</html>