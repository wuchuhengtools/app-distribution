<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$action=SafeRequest("action","get");
switch($action){
	case 'createsql':
		mainjump();
		create_sql();
		break;
	case 'mainjump':
		mainjump();
		break;
	default:
		main();
		break;
} function main(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>ִ�����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function CheckForm(){
        if(document.form.in_pass.value==""){
            asyncbox.tips("���벻��Ϊ�գ������룡", "wait", 1000);
            document.form.in_pass.focus();
            return false;
        }
        else if(document.form.in_sql.value==""){
            asyncbox.tips("��䲻��Ϊ�գ�����д��", "wait", 1000);
            document.form.in_sql.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ���� - ִ�����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='����&nbsp;&raquo;&nbsp;ִ�����';</script>
<div class="floattop"><div class="itemtitle"><h3>ִ�����</h3></div></div><div class="floattopempty"></div>
<form method="post" name="form" action="?iframe=sql&action=createsql" target="iframe">
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>ִ��ǰ����ȷ������еı�ǰ׺�Ƿ�Ϊ��<em class="lightnum"><?php echo IN_DBTABLE; ?></em>��</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<tr><td>���룺<input type="password" class="txt" name="in_pass" id="in_pass">&nbsp;&nbsp;Ϊ��������ύ������֤��ǰϵͳ�û��ĵ�¼����</td></tr>
</table>
<table class="tb tb2">
<tr><td><div style="height:100px;line-height:100px;float:left;">��䣺</div><textarea rows="6" cols="50" id="in_sql" name="in_sql" style="width:400px;height:100px;"></textarea></td></tr>
<tr><td><input type="submit" class="btn" value="�ύ" onclick="return CheckForm();" /></td></tr>
</table>
</form>
<h3>Ear Music ��ʾ</h3>
<div class="infobox"><iframe name="iframe" frameborder="0" width="100%" height="100%" src="?iframe=sql&action=mainjump"></iframe></div>
</div>
</body>
</html>
<?php
} function create_sql(){
        global $db;
        if(md5(md5(SafeRequest("in_pass","post"))) !== $_COOKIE['in_adminpassword']){exit("<span style=\"color:#C00\">ִ��ʧ�ܣ���¼��������</span>");}
	if($db->query(stripslashes(SafeRequest("in_sql","post",1)))){
		echo "<span style=\"color:#090\">��ϲ�����ִ����ϣ�</span>";
	}else{
		echo "<span style=\"color:#C00\">".$db->mysql_error()."</span>";
	}
}
?>