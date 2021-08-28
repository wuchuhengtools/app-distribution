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
<title>ϵͳ�û�</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
function CheckForm(){
	if(document.form.in_adminname.value==""){
		asyncbox.tips("��¼�ʺŲ���Ϊ�գ�����д��", "wait", 1000);
		document.form.in_adminname.focus();
		return false;
        }
        else {
		return true;
        }
}
function del_msg(href) {
	$.layer({
		shade: [0],
		area: ['auto', 'auto'],
		dialog: {
			msg: 'ɾ�����������棬ȷ�ϼ�����',
			btns: 2,
			type: 4,
			btn: ['ȷ��', 'ȡ��'],
			yes: function() {
				location.href = href;
			},
			no: function() {
				layer.msg('��ȡ��ɾ��', 1, 0);
			}
		}
	});
}
</script>
</head>
<body>
<?php
switch($action){
	case 'add':
		Add();
		break;
	case 'saveadd':
		SaveAdd();
		break;
	case 'edit':
		Edit();
		break;
	case 'saveedit':
		SaveEdit();
		break;
	case 'islock':
		IsLock();
		break;
	case 'del':
		Del();
		break;
	default:
		main();
		break;
	}
?>
</body>
</html>
<?php
function main(){
	global $db;
	$sql="select * from ".tname('admin');
	$result=$db->query($sql);
	$count=$db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ϵͳ - ϵͳ�û�';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ϵͳ&nbsp;&raquo;&nbsp;ϵͳ�û�';</script>
<div class="floattop"><div class="itemtitle"><h3>ϵͳ�û�</h3><ul class="tab1">
<li class="current"><a href="?iframe=admin"><span>ϵͳ�û�</span></a></li>
<li><a href="?iframe=admin&action=add"><span>�����û�</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">�û��б�</th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>�ʺ�</th>
<th>��¼ʱ��</th>
<th>��¼����</th>
<th>״̬</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û��ϵͳ�û�</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><?php echo $row['in_adminid']; ?></td>
<td><a href="?iframe=admin&action=edit&in_adminid=<?php echo $row['in_adminid']; ?>" class="act"><?php echo $row['in_adminname']; ?></a></td>
<td class="lightnum"><?php echo $row['in_logintime']; ?></td>
<td><?php echo $row['in_loginnum']; ?></td>
<td><?php if($row['in_islock']==1){ ?><a href="?iframe=admin&action=islock&in_adminid=<?php echo $row['in_adminid']; ?>&in_islock=0&hash=<?php echo $_COOKIE['in_adminpassword']; ?>"><img src="static/admincp/css/show_no.gif" /></a><?php }else{ ?><a href="?iframe=admin&action=islock&in_adminid=<?php echo $row['in_adminid']; ?>&in_islock=1&hash=<?php echo $_COOKIE['in_adminpassword']; ?>"><img src="static/admincp/css/show_yes.gif" /></a><?php } ?></td>
<td><a href="?iframe=admin&action=edit&in_adminid=<?php echo $row['in_adminid']; ?>" class="act">�༭</a><a class="act" style="cursor:pointer" onclick="del_msg('?iframe=admin&action=del&in_adminid=<?php echo $row['in_adminid']; ?>&hash=<?php echo $_COOKIE['in_adminpassword']; ?>');">ɾ��</a></td>
</tr>
<?php
}
}
?>
</table>
</div>


<?php
}
function EditBoard($Arr,$url,$arrname){
	$in_adminname = $Arr[0];
	$in_islock = $Arr[1];
	$in_permission = $Arr[2];
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ϵͳ - <?php echo $arrname; ?>�û�';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ϵͳ&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>�û�';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>�û�</h3><ul class="tab1">
<li><a href="?iframe=admin"><span>ϵͳ�û�</span></a></li>
<?php if($_GET['action']=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=admin&action=add"><span>�����û�</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<form action="<?php echo $url; ?>" method="post" name="form">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<tr><th colspan="15" class="partition"><?php echo $arrname; ?>�û�</th></tr>
<tr><td colspan="2" class="td27">��¼�ʺ�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo $in_adminname; ?>" name="in_adminname" id="in_adminname"></td></tr>
<tr><td colspan="2" class="td27">��¼����:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword" id="in_adminpassword"></td><td class="vtop tips2"><?php if($_GET['action']=="edit"){echo "���޸�������";} ?></td></tr>
<tr><td colspan="2" class="td27">ȷ������:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword1" id="in_adminpassword1"></td></tr>
<tr><td colspan="2" class="td27">Ȩ������:</td></tr>
<tr>
<td class="vtop"><ul>
<?php if(ergodic_array($in_permission,1)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value1" value="1"<?php if(ergodic_array($in_permission,1)){echo " checked";} ?>><label for="value1">��ҳ</label></li>
<?php if(ergodic_array($in_permission,2)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value2" value="2"<?php if(ergodic_array($in_permission,2)){echo " checked";} ?>><label for="value2">ȫ��</label></li>
<?php if(ergodic_array($in_permission,3)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value3" value="3"<?php if(ergodic_array($in_permission,3)){echo " checked";} ?>><label for="value3">Ӧ��</label></li>
<?php if(ergodic_array($in_permission,4)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value4" value="4"<?php if(ergodic_array($in_permission,4)){echo " checked";} ?>><label for="value4">�û�</label></li>
<?php if(ergodic_array($in_permission,5)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value5" value="5"<?php if(ergodic_array($in_permission,5)){echo " checked";} ?>><label for="value5">����</label></li>
<?php if(ergodic_array($in_permission,6)){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="checkbox" type="checkbox" name="in_permission[]" id="value6" value="6"<?php if(ergodic_array($in_permission,6)){echo " checked";} ?>><label for="value6">ϵͳ</label></li>
</ul></td>
<td class="vtop"><select name="in_islock" class="ps">
<option value="0"<?php if($in_islock==0){echo " selected";} ?>>����״̬</option>
<option value="1"<?php if($in_islock==1){echo " selected";} ?>>����״̬</option>
</select></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" onclick="return CheckForm();" value="�ύ" /></div></td></tr>
</form>
</table>
</div>



<?php
}
	//����༭����
	function SaveEdit(){
		global $db;
		if(!submitcheck('hash', 1)){ShowMessage("����·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_adminid=intval(SafeRequest("in_adminid","get"));
		$in_adminname=SafeRequest("in_adminname","post");
		$in_adminpassword=SafeRequest("in_adminpassword","post");
		$in_adminpassword1=SafeRequest("in_adminpassword1","post");
		$in_islock=SafeRequest("in_islock","post");
		$in_permission=RequestBox("in_permission");
		if($in_adminpassword!==$in_adminpassword1){ShowMessage("�༭ʧ�ܣ�����������д��һ�£�","history.back(1);","infotitle3",3000,2);}
		if($db->getone("select in_adminid from ".tname('admin')." where in_adminid<>".$in_adminid." and in_adminname='".$in_adminname."'")){ShowMessage("�༭�������ʺ��Ѿ����ڣ�","history.back(1);","infotitle3",3000,2);}
		if(empty($in_adminpassword1)){
			$sql="update ".tname('admin')." set in_adminname='".$in_adminname."',in_permission='".$in_permission."',in_islock=".$in_islock." where in_adminid=".$in_adminid;
		}else{
			$sql="update ".tname('admin')." set in_adminpassword='".md5($in_adminpassword)."',in_adminname='".$in_adminname."',in_permission='".$in_permission."',in_islock=".$in_islock." where in_adminid=".$in_adminid;
		}
		$db->query($sql);
		ShowMessage("��ϲ����ϵͳ�û��༭�ɹ������µ�¼����Ч��",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
	}

	//�༭����
	function Edit(){
		global $db;
		$in_adminid=intval(SafeRequest("in_adminid","get"));
		$sql="select * from ".tname('admin')." where in_adminid=".$in_adminid;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_adminname'],$row['in_islock'],$row['in_permission']);
		}
		EditBoard($Arr,"?iframe=admin&action=saveedit&in_adminid=".$in_adminid,"�༭");
	}

	//ɾ������
	function Del(){
		global $db;
		if(!submitcheck('hash', -1)){ShowMessage("������·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_adminid=intval(SafeRequest("in_adminid","get"));
		if($in_adminid==1){ShowMessage("��Ǹ��Ĭ���ʺŲ�����ɾ����","?iframe=admin","infotitle3",3000,1);}
		$sql="delete from ".tname('admin')." where in_adminid=".$in_adminid;
		if($db->query($sql)){
			ShowMessage("��ϲ����ϵͳ�û�ɾ���ɹ���","?iframe=admin","infotitle2",3000,1);
		}
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('hash', 1)){ShowMessage("����·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_adminname=SafeRequest("in_adminname","post");
		$in_adminpassword=SafeRequest("in_adminpassword","post");
		$in_adminpassword1=SafeRequest("in_adminpassword1","post");
		$in_islock=SafeRequest("in_islock","post");
		$in_permission=RequestBox("in_permission");
		if(empty($in_adminpassword) || $in_adminpassword!==$in_adminpassword1){ShowMessage("����ʧ�ܣ�����Ϊ�ջ�����������д��һ�£�","history.back(1);","infotitle3",3000,2);}
		if($db->getone("select in_adminid from ".tname('admin')." where in_adminname='".$in_adminname."'")){
			ShowMessage("�����������ʺ��Ѿ����ڣ�","history.back(1);","infotitle3",3000,2);
		}else{
			$sql="Insert ".tname('admin')." (in_adminname,in_adminpassword,in_loginnum,in_islock,in_permission) values ('".$in_adminname."','".md5($in_adminpassword1)."',0,".$in_islock.",'".$in_permission."')";
			if($db->query($sql)){
				ShowMessage("��ϲ����ϵͳ�û������ɹ���","?iframe=admin","infotitle2",1000,1);
			}else{
				ShowMessage("��������ϵͳ�û�����ʧ�ܣ�","?iframe=admin","infotitle3",3000,1);
			}
		}
	}

	//�������
	function Add(){
		$Arr=array("","","");
		EditBoard($Arr,"?iframe=admin&action=saveadd","����");
	}

	//����״̬
	function IsLock(){
		global $db;
		if(!submitcheck('hash', -1)){ShowMessage("������·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_adminid=intval(SafeRequest("in_adminid","get"));
		$in_islock=intval(SafeRequest("in_islock","get"));
		$sql="update ".tname('admin')." set in_islock=".$in_islock." where in_adminid=".$in_adminid;
		if($db->query($sql)){
			ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=admin","infotitle2",1000,1);
		}
	}
?>