<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(4);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�û�����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
</head>
<body>
<?php
switch($action){
	case 'edit':
		Edit();
		break;
	case 'saveedit':
		SaveEdit();
		break;
	case 'allsave':
		AllSave();
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('user')." where in_username like '%".$key."%' order by in_regdate desc",20);
		break;
	case 'lock':
		main("select * from ".tname('user')." where in_islock=1 order by in_regdate desc",20);
		break;
	default:
		main("select * from ".tname('user')." order by in_regdate desc",20);
		break;
	}
?>
</body>
</html>
<?php
function EditBoard($Arr,$url){
	global $db;
	$app=$db->num_rows($db->query("select count(*) from ".tname('app')." where in_uid=".$Arr[0]));
	$in_username = $Arr[1];
	$in_mobile = $Arr[2];
	$in_qq = $Arr[3];
	$in_firm = $Arr[4];
	$in_job = $Arr[5];
	$in_islock = $Arr[6];
	$in_points = $Arr[7];
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - �û� - �༭�û�';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�&nbsp;&raquo;&nbsp;�༭�û�';</script>
<div class="floattop"><div class="itemtitle"><h3>�༭�û�</h3><ul class="tab1">
<li><a href="?iframe=user"><span>�����û�</span></a></li>
<li><a href="?iframe=user&action=lock"><span>����״̬</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr><td colspan="2" class="td27">�û���:</td></tr>
<tr><td class="vtop rowform"><?php echo $in_username; ?></td></tr>
<tr><td colspan="2" class="td27">ͷ��:</td></tr>
<tr class="noborder"><td class="vtop rowform"><img width="120" height="120" src="<?php echo getavatar($Arr[0]); ?>" /><br /><br /><input name="editavatar" class="checkbox" type="checkbox" value="1"<?php if(!is_file('data/attachment/avatar/'.$Arr[0].'.jpg')){ ?> disabled="disabled"<?php } ?> /> ɾ��ͷ��</td></tr>
<tr><td colspan="2" class="td27">ͳ����Ϣ:</td></tr>
<tr class="noborder"><td class="vtop rowform">
<a href="?iframe=app&action=keyword&key=<?php echo $in_username; ?>" class="act">Ӧ����(<?php echo $app; ?>)</a>
</td></tr>
<tr><td colspan="2" class="td27">������:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_userpassword" name="in_userpassword" type="text" class="txt" /></td><td class="vtop tips2">�������������˴�������</td></tr>
<tr><td colspan="2" class="td27">�ֻ�:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_mobile" name="in_mobile" value="<?php echo $in_mobile; ?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">QQ:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_qq" name="in_qq" value="<?php echo $in_qq; ?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">��˾:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_firm" name="in_firm" value="<?php echo $in_firm; ?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">ְλ:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_job" name="in_job" value="<?php echo $in_job; ?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">���ص���:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input type="text" id="in_points" name="in_points" class="px" value="<?php echo $in_points; ?>" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /></td></tr>
<tr><td colspan="2" class="td27">����״̬:</td></tr>
<tr class="noborder"><td class="vtop rowform"><select id="in_islock" name="in_islock" class="ps">
<option value="0">��</option>
<option value="1"<?php if($in_islock==1){echo " selected";} ?>>��</option>
</select></td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="edit" value="�ύ" /></div></td></tr>
</table>
</form>
</div>



<?php
}
function main($sql,$size){
	global $db,$action;
	$Arr=getpagerow($sql,$size);
	$result=$Arr[1];
	$count=$Arr[2];
?>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<link href="static/pack/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
        all_save(form);
}
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
function all_save(form){
        var opt=document.getElementById("in_allsave").value;
        if(form.chkall.checked && opt=="0"){
		layer.tips('ɾ���û������棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - �û� - �����û�';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�&nbsp;&raquo;&nbsp;�����û�';</script>";} ?>
<?php if($action=="lock"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - �û� - ����״̬';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�&nbsp;&raquo;&nbsp;����״̬';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - �û� - �����û�';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�&nbsp;&raquo;&nbsp;�����û�';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "�����û�";}else if($action=="lock"){echo "����״̬";}else if($action=="keyword"){echo "�����û�";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=user"><span>�����û�</span></a></li>
<?php if($action=="lock"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=user&action=lock"><span>����״̬</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>���������û����ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="user">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=user&action=allsave">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>ͷ��</th>
<th>�û���</th>
<th>���ص���</th>
<th>״̬</th>
<th>��¼ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û���û�</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#thumb<?php echo $row['in_userid']; ?>").fancybox({
		'overlayColor': '#000',
		'overlayOpacity': 0.1,
		'overlayShow': true,
		'transitionIn': 'elastic',
		'transitionOut': 'elastic'
	});
});
</script>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_userid[]" id="in_userid" value="<?php echo $row['in_userid']; ?>"><?php echo $row['in_userid']; ?></td>
<td><a href="<?php echo getavatar($row['in_userid']); ?>" id="thumb<?php echo $row['in_userid']; ?>"><img src="<?php echo getavatar($row['in_userid']); ?>" width="25" height="25" /></a></td>
<td><?php echo str_replace(SafeRequest("key","get"), '<em class="lightnum">'.SafeRequest("key","get").'</em>', $row['in_username']); ?></td>
<td><?php echo $row['in_points']; ?></td>
<td><?php if($row['in_islock']==1){echo "<em class=\"lightnum\">����</em>";}else{echo "����";} ?></td>
<td><?php if(date('Y-m-d', strtotime($row['in_logintime'])) == date('Y-m-d')){echo '<em class="lightnum">'.$row['in_logintime'].'</em>';}else{echo $row['in_logintime'];} ?></td>
<td><a href="?iframe=user&action=edit&in_userid=<?php echo $row['in_userid']; ?>" class="act">�༭</a></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <select id="in_allsave" name="in_allsave" onchange="all_save(this.form);">
<option value="0">ɾ���û�</option>
<option value="1">����״̬</option>
<option value="2">����״̬</option>
</select> &nbsp;&nbsp; <input type="submit" name="allsave" class="btn" value="��������" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//��������
	function AllSave(){
		global $db;
		if(!submitcheck('allsave')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_userid = RequestBox("in_userid");
		$in_allsave = SafeRequest("in_allsave","post");
		if($in_userid==0){
			ShowMessage("��������ʧ�ܣ����ȹ�ѡҪ�������û���",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			if($in_allsave==0){
		                $query = $db->query("select in_userid from ".tname('user')." where in_userid in ($in_userid)");
		                while ($row = $db->fetch_array($query)) {
			                @unlink('data/attachment/avatar/'.$row['in_userid'].'.jpg');
		                }
				$sql = "delete from ".tname('user')." where in_userid in ($in_userid)";
				if($db->query($sql)){
					$db->query("delete from ".tname('buylog')." where in_lock=1 and in_uid in ($in_userid)");
					$db->query("delete from ".tname('paylog')." where in_lock=1 and in_uid in ($in_userid)");
					$db->query("delete from ".tname('mail')." where in_uid in ($in_userid)");
					ShowMessage("��ϲ�����û�����ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
				}
			}elseif($in_allsave==1){
				$db->query("update ".tname('user')." set in_islock=0 where in_userid in ($in_userid)");
				ShowMessage("��ϲ�����û���������ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
			}elseif($in_allsave==2){
				$db->query("update ".tname('user')." set in_islock=1 where in_userid in ($in_userid)");
				ShowMessage("��ϲ�����û����������ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_userid = intval(SafeRequest("in_userid","get"));
		$sql = "select * from ".tname('user')." where in_userid=".$in_userid;
		if($row=$db->getrow($sql)){
			$Arr = array($row['in_userid'],$row['in_username'],$row['in_mobile'],$row['in_qq'],$row['in_firm'],$row['in_job'],$row['in_islock'],$row['in_points']);
		}
		EditBoard($Arr,"?iframe=user&action=saveedit&in_userid=".$in_userid);
	}

	//����༭
	function SaveEdit(){
		global $db;
		if(!submitcheck('edit')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_userid = intval(SafeRequest("in_userid","get"));
		$editavatar = SafeRequest("editavatar","post");
		$in_userpassword = SafeRequest("in_userpassword","post");
		$in_mobile = SafeRequest("in_mobile","post");
		$in_qq = SafeRequest("in_qq","post");
		$in_firm = SafeRequest("in_firm","post");
		$in_job = SafeRequest("in_job","post");
		$in_points = !is_numeric(SafeRequest("in_points","post")) ? 0 : SafeRequest("in_points","post");
		$in_islock = SafeRequest("in_islock","post");
		if($editavatar==1){
			@unlink('data/attachment/avatar/'.$in_userid.'.jpg');
		}
		$userpassword = NULL;
		if(!empty($in_userpassword)){
			$userpassword = "in_userpassword='".substr(md5($in_userpassword),8,16)."',";
		}
		$db->query("update ".tname('user')." set ".$userpassword."in_mobile='".$in_mobile."',in_qq='".$in_qq."',in_firm='".$in_firm."',in_job='".$in_job."',in_points=".$in_points.",in_islock=".$in_islock." where in_userid=".$in_userid);
		ShowMessage("��ϲ�����û��༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
	}
?>