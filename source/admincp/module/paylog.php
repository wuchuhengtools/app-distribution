<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(6);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>����¼</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function s(){
        var k=document.getElementById("search").value;
        if(k==""){
                asyncbox.tips("������Ҫ��ѯ�Ĺؼ��ʣ�", "wait", 1000);
                document.getElementById("search").focus();
                return false;
        }else{
                document.btnsearch.submit();
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'keyword':
		$key=SafeRequest("key","get");
		$sql="select * from ".tname('paylog')." where in_title like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc";
		main($sql,20);
		break;
	default:
		$lock=SafeRequest("lock","get");
		if(!is_numeric($lock)){
		        $sql="select * from ".tname('paylog')." order by in_addtime desc";
		}else{
		        $sql="select * from ".tname('paylog')." where in_lock=".$lock." order by in_addtime desc";
		}
		main($sql,20);
		break;
	}
?>
</body>
</html>
<?php
function main($sql,$size){
	global $db;
	$Arr=getpagerow($sql,$size);
	$result=$Arr[1];
	$count=$Arr[2];
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ϵͳ - ����¼';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ϵͳ&nbsp;&raquo;&nbsp;����¼';</script>
<div class="floattop"><div class="itemtitle"><h3>����¼</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>�������붩���š�֧����Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="paylog">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=paylog">����״̬</option>
<option value="?iframe=paylog&lock=0"<?php if(isset($_GET['lock']) && $_GET['lock']==0){echo " selected";} ?>>֧���ɹ�</option>
<option value="?iframe=paylog&lock=1"<?php if(isset($_GET['lock']) && $_GET['lock']==1){echo " selected";} ?>>֧��ʧ��</option>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<table class="tb tb2">
<tr class="header">
<th>������</th>
<th>��ֵ����</th>
<th>֧�����</th>
<th>֧��״̬</th>
<th>֧����Ա</th>
<th>֧��ʱ��</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û�г���¼</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td><?php echo str_replace(SafeRequest("key","get"), '<em class="lightnum">'.SafeRequest("key","get").'</em>', $row['in_title']); ?></td>
<td><?php echo $row['in_points']; ?></td>
<td><?php echo $row['in_money']; ?></td>
<td><?php if($row['in_lock']==0){echo '�ɹ�';}else{echo '<em class="lightnum">ʧ��</em>';} ?></td>
<td><a href="?iframe=paylog&action=keyword&key=<?php echo $row['in_uname']; ?>" class="act"><?php echo str_replace(SafeRequest("key","get"), '<em class="lightnum">'.SafeRequest("key","get").'</em>', $row['in_uname']); ?></a></td>
<td><?php if(date('Y-m-d', strtotime($row['in_addtime'])) == date('Y-m-d')){echo '<em class="lightnum">'.$row['in_addtime'].'</em>';}else{echo $row['in_addtime'];} ?></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<?php echo $Arr[0]; ?>
</table>
</div>
<?php } ?>