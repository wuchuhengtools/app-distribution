<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>������</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function clean_ing(){
	var tmp=document.getElementById("tmp").value;
	var sql=document.getElementById("sql").value;
	if(!document.getElementById("tmp").checked){
		tmp=0;
	}
	if(!document.getElementById("sql").checked){
		sql=0;
	}
        if(tmp<1 && sql<1){
		asyncbox.tips("������Ҫ��ѡһ�", "wait", 1000);
        }else{
		document.getElementById("loader").innerHTML='<h4 class="infotitle1">���������棬���Ե�...</h4><img src="static/admincp/css/loader.gif" class="marginbot" />';
		location.href='?iframe=clean&action=save&tmp='+tmp+'&sql='+sql;
        }
}
</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ���� - ������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='����&nbsp;&raquo;&nbsp;������';</script>
<div class="floattop"><div class="itemtitle"><h3>������</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>������ǰ�����ȹر�վ��</li>
<li>�粻�ܹ�ѡĳ�������˵�����������޻���</li>
</ul></td></tr>
</table>
<h3>Ear Music ��ʾ</h3>
<?php
switch($action){
	case 'save':
		save();
		break;
	default:
		main();
		break;
	}
?>
</div>
</body>
</html>
<?php
function main(){
	global $db;
	$tmp = " checked";
	$sql = " checked";
	$m_num = $db->num_rows($db->query("select count(*) from ".tname('mail')));
        if(!is_dir('data/tmp/')){
	        $tmp = " disabled";
        }
        if(!$m_num){
	        $sql = " disabled";
        }
        echo "<div class=\"infobox\" id=\"loader\"><br /><h4 class=\"marginbot normal\"><input class=\"checkbox\" type=\"checkbox\" id=\"tmp\" value=\"1\"".$tmp."><label for=\"tmp\">��ʱ�ļ�</label><input class=\"checkbox\" type=\"checkbox\" id=\"sql\" value=\"1\"".$sql."><label for=\"sql\">��������</label></h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"��ʼ����\" onclick=\"clean_ing();\"></p><br /></div>";
}
function save(){
	global $db;
	$tmp = SafeRequest("tmp","get");
	$sql = SafeRequest("sql","get");
	if($tmp == 1){
	        destroyDir('data/tmp/');
	}
	if($sql == 1){
	        $db->query("delete from ".tname('mail'));
	}
	echo "<div class=\"infobox\"><br /><h4 class=\"infotitle2\">��ϲ�������Ѿ�ȫ��������ϣ�</h4><br /></div>";
}
?>