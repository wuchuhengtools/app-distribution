<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>Ӧ�ù���</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
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
	case 'alldel':
		AllDel();
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		if(is_numeric($key)){
		        $sql="select * from ".tname('app')." where in_id=$key order by in_addtime desc";
		}else{
		        $sql="select * from ".tname('app')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc";
		}
		main($sql,20);
		break;
	default:
		$form=SafeRequest("form","get");
		if(empty($form)){
		        $sql="select * from ".tname('app')." order by in_addtime desc";
		}else{
		        $sql="select * from ".tname('app')." where in_form='".$form."' order by in_addtime desc";
		}
		main($sql,20);
		break;
	}
?>
</body>
</html>
<?php
function EditBoard($Arr,$url,$arrname){
	global $db,$action;
	$one = $db->getone("select in_userid from ".tname('user')." where in_username='".$_COOKIE['in_adminname']."'");
	$in_name = $Arr[0];
	$in_uname = empty($Arr[1]) && $one ? $_COOKIE['in_adminname'] : $Arr[1];
	$in_type = intval($Arr[2]);
	$in_mnvs = $Arr[3];
	$in_form = $Arr[4];
	$in_size = $Arr[5];
	$in_bid = $Arr[6];
	$in_bsvs = $Arr[7];
	$in_bvs = $Arr[8];
	$in_nick = $Arr[9];
	$in_team = $Arr[10];
	$in_icon = $Arr[11];
	$in_plist = $Arr[12];
	$in_kid = intval($Arr[13]);
	$signid = $db->getone("select in_id from ".tname('signlog')." where in_aid=".intval($Arr[14]));
?>
<script type="text/javascript">
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	}
}
function CheckForm(){
        if(document.form2.in_name.value==""){
            asyncbox.tips("Ӧ�����Ʋ���Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_name.focus();
            return false;
        }
        else if(document.form2.in_uname.value==""){
            asyncbox.tips("������Ա����Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_uname.focus();
            return false;
        }
        else if(document.form2.in_plist.value==""){
            asyncbox.tips("���õ�ַ����Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_plist.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - Ӧ�� - <?php echo $arrname; ?>Ӧ��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='Ӧ��&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>Ӧ��';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>Ӧ��</h3><ul class="tab1">
<li><a href="?iframe=app"><span>����Ӧ��</span></a></li>
<?php if($action=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=app&action=add"><span>����Ӧ��</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr><td class="td29">Ӧ�����ƣ�<input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name"></td><td class="td29">������Ա��<input type="text" class="txt" value="<?php echo $in_uname; ?>" name="in_uname" id="in_uname"></td></tr>
<tr>
<td>�汾���ͣ�<select name="in_type" id="in_type">
<option value="0">�ڲ��</option>
<option value="1"<?php if($in_type==1){echo " selected";} ?>>��ҵ��</option>
</select></td>
<td class="td29">�汾���ݣ�<input type="text" class="txt" value="<?php echo $in_mnvs; ?>" name="in_mnvs" id="in_mnvs"></td>
</tr>
<tr><td class="td29">Ӧ��ƽ̨��<input type="text" class="txt" value="<?php echo $in_form; ?>" name="in_form" id="in_form"></td><td class="td29">Ӧ�ô�С��<input type="text" class="txt" value="<?php echo $in_size; ?>" name="in_size" id="in_size"></td></tr>
<tr><td class="td29">Ӧ�ñ�ʶ��<input type="text" class="txt" value="<?php echo $in_bid; ?>" name="in_bid" id="in_bid"></td><td class="td29">Ӧ�ù�����<input type="text" class="txt" value="<?php echo $in_kid; ?>" name="in_kid" id="in_kid" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td></tr>
<tr><td class="longtxt">����汾��<input type="text" class="txt" value="<?php echo $in_bsvs; ?>" name="in_bsvs" id="in_bsvs"></td></tr>
<tr><td class="longtxt">��ϸ�汾��<input type="text" class="txt" value="<?php echo $in_bvs; ?>" name="in_bvs" id="in_bvs"></td></tr>
<tr><td class="longtxt">��˾���ƣ�<input type="text" class="txt" value="<?php echo $in_nick; ?>" name="in_nick" id="in_nick"></td></tr>
<tr><td class="longtxt">������Ϣ��<input type="text" class="txt" value="<?php echo $in_team; ?>" name="in_team" id="in_team"></td></tr>
<tr><td class="longtxt">ͼ���ļ���<input type="text" class="txt" value="<?php echo $in_icon; ?>" name="in_icon" id="in_icon"></td><?php if($Arr[14]){ ?><td><div class="rssbutton"><input type="button" value="�ϴ�ͼ��" onclick="pop.up('no', '�ϴ�ͼ��', 'source/pack/upload/admin-open-icon.php?id=<?php echo $Arr[14]; ?>', '406px', '180px', '175px');" /></div></td><?php } ?></tr>
<tr><td class="longtxt diffcolor3">���õ�ַ��<input type="text" class="txt" value="<?php echo $in_plist; ?>" name="in_plist" id="in_plist"></td><td><div class="rssbutton"><input type="button" value="�ϴ�Ӧ��" onclick="pop.up('no', '�ϴ�Ӧ��', 'source/pack/upload/admin-open.php', '406px', '180px', '175px');" /></div></td></tr>
<tr><td><input type="submit" class="btn" name="form2" id="btnsave" value="�ύ" onclick="return CheckForm();" /><?php if($signid){ ?><input class="checkbox" type="checkbox" id="signid" name="signid" value="<?php echo $signid; ?>" checked /><label for="signid">����ǩ��</label><?php } ?></td></tr>
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
        if(form.chkall.checked){
		layer.tips('ɾ��Ӧ�ò����棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - Ӧ�� - ����Ӧ��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='Ӧ��&nbsp;&raquo;&nbsp;����Ӧ��';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - Ӧ�� - ����Ӧ��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='Ӧ��&nbsp;&raquo;&nbsp;����Ӧ��';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "����Ӧ��";}else if($action=="keyword"){echo "����Ӧ��";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=app"><span>����Ӧ��</span></a></li>
<li><a href="?iframe=app&action=add"><span>����Ӧ��</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<?php
if(empty($action)){
echo "<li>���������е�Ӧ��</li>";
}elseif($action=="keyword"){
echo "<li>������������".SafeRequest("key","get")."����Ӧ��</li>";
}
?>
<li>���������š�Ӧ�����ơ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="app">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=app">����ƽ̨</option>
<option value="?iframe=app&form=iOS"<?php if(isset($_GET['form']) && $_GET['form']=='iOS'){echo " selected";} ?>>iOS</option>
<option value="?iframe=app&form=Android"<?php if(isset($_GET['form']) && $_GET['form']=='Android'){echo " selected";} ?>>Android</option>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=app&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>Ӧ��ͼ��</th>
<th>Ӧ������</th>
<th>Ӧ��ƽ̨</th>
<th>������Ա</th>
<th>��ҵǩ��</th>
<th>����ʱ��</th>
<th>��װͳ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û��Ӧ��</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#thumb<?php echo $row['in_id']; ?>").fancybox({
		'overlayColor': '#000',
		'overlayOpacity': 0.1,
		'overlayShow': true,
		'transitionIn': 'elastic',
		'transitionOut': 'elastic'
	});
});
</script>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><a href="<?php echo geticon($row['in_icon']); ?>" id="thumb<?php echo $row['in_id']; ?>"><img src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='static/app/<?php echo $row['in_form']; ?>.png'" width="25" height="25" /></a></td>
<td><a href="<?php echo getlink($row['in_id']); ?>" target="_blank" class="act"><?php echo str_replace(SafeRequest("key","get"), '<em class="lightnum">'.SafeRequest("key","get").'</em>', $row['in_name']); ?></a></td>
<td><?php echo $row['in_form']; ?></td>
<td><a href="?iframe=app&action=keyword&key=<?php echo $row['in_uname']; ?>" class="act"><?php echo str_replace(SafeRequest("key","get"), '<em class="lightnum">'.SafeRequest("key","get").'</em>', $row['in_uname']); ?></a></td>
<td><?php if($row['in_sign']){echo '<em class="lightnum">�ѿ�ͨ('.$row['in_resign'].')</em>';}else{echo 'δ��ͨ';} ?></td>
<td><?php if(date('Y-m-d', strtotime($row['in_addtime'])) == date('Y-m-d')){echo '<em class="lightnum">'.$row['in_addtime'].'</em>';}else{echo date('Y-m-d', strtotime($row['in_addtime']));} ?></td>
<td><?php echo $row['in_hits']; ?></td>
<td><a href="?iframe=app&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <input type="submit" name="form" class="btn" value="����ɾ��" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//����ɾ��
	function AllDel(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ����Ӧ�ã�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			$query = $db->query("select in_icon from ".tname('app')." where in_id in ($in_id)");
			while($row = $db->fetch_array($query)){
			        @unlink('data/attachment/'.$row['in_icon']);
			        @unlink('data/attachment/'.str_replace('.png', '.plist', $row['in_icon']));
			        @unlink('data/attachment/'.str_replace('.png', '.ipa', $row['in_icon']));
			        @unlink('data/attachment/'.str_replace('.png', '.apk', $row['in_icon']));
			}
			$sql="delete from ".tname('app')." where in_id in ($in_id)";
			if($db->query($sql)){
				$db->query("delete from ".tname('signlog')." where in_aid in ($in_id)");
				ShowMessage("��ϲ����Ӧ������ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('app')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_uname'],$row['in_type'],$row['in_mnvs'],$row['in_form'],$row['in_size'],$row['in_bid'],$row['in_bsvs'],$row['in_bvs'],$row['in_nick'],$row['in_team'],$row['in_icon'],$row['in_plist'],$row['in_kid'],$in_id);
		}
		EditBoard($Arr,"?iframe=app&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","","","","","","","","","","","");
		EditBoard($Arr,"?iframe=app&action=saveadd","����");
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_type = SafeRequest("in_type","post");
		$in_mnvs = SafeRequest("in_mnvs","post");
		$in_form = SafeRequest("in_form","post");
		$in_size = SafeRequest("in_size","post");
		$in_bid = SafeRequest("in_bid","post");
		$in_bsvs = SafeRequest("in_bsvs","post");
		$in_bvs = SafeRequest("in_bvs","post");
		$in_nick = SafeRequest("in_nick","post");
		$in_team = SafeRequest("in_team","post");
		$in_icon = SafeRequest("in_icon","post");
		$in_plist = SafeRequest("in_plist","post");
		$in_kid = intval(SafeRequest("in_kid","post"));
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$db->query("Insert ".tname('app')." (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_plist,in_hits,in_kid,in_sign,in_resign,in_addtime) values ('".$in_name."',".$row['in_userid'].",'".$row['in_username']."',".$in_type.",'".$in_size."','".$in_form."','".$in_mnvs."','".$in_bid."','".$in_bsvs."','".$in_bvs."','".$in_nick."','".$in_team."','".$in_icon."','".$in_plist."',0,".$in_kid.",0,0,'".date('Y-m-d H:i:s')."')");
			ShowMessage("��ϲ����Ӧ�������ɹ���","?iframe=app","infotitle2",1000,1);
		}else{
			ShowMessage("����ʧ�ܣ�������Ա�����ڣ�","history.back(1);","infotitle3",3000,2);
		}
	}

	//����༭����
	function SaveEdit(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = intval(SafeRequest("in_id","get"));
		$in_name = SafeRequest("in_name","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_type = SafeRequest("in_type","post");
		$in_mnvs = SafeRequest("in_mnvs","post");
		$in_form = SafeRequest("in_form","post");
		$in_size = SafeRequest("in_size","post");
		$in_bid = SafeRequest("in_bid","post");
		$in_bsvs = SafeRequest("in_bsvs","post");
		$in_bvs = SafeRequest("in_bvs","post");
		$in_nick = SafeRequest("in_nick","post");
		$in_team = SafeRequest("in_team","post");
		$in_icon = SafeRequest("in_icon","post");
		$in_plist = SafeRequest("in_plist","post");
		$in_kid = intval(SafeRequest("in_kid","post"));
		$signid = intval(SafeRequest("signid","post"));
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$old_icon = getfield('app', 'in_icon', 'in_id', $in_id);
			if($in_icon !== $old_icon){
				$del = 'data/attachment/'.$old_icon;
				@unlink($del);
				@unlink(str_replace('.png', '.plist', $del));
				@unlink(str_replace('.png', '.ipa', $del));
				@unlink(str_replace('.png', '.apk', $del));
			}
			$signid and updatetable('signlog', array('in_status' => 2), array('in_id' => $signid));
			$db->query("update ".tname('app')." set in_name='".$in_name."',in_uid=".$row['in_userid'].",in_uname='".$row['in_username']."',in_type=".$in_type.",in_size='".$in_size."',in_form='".$in_form."',in_mnvs='".$in_mnvs."',in_bid='".$in_bid."',in_bsvs='".$in_bsvs."',in_bvs='".$in_bvs."',in_nick='".$in_nick."',in_team='".$in_team."',in_icon='".$in_icon."',in_plist='".$in_plist."',in_kid=".$in_kid.",in_addtime='".date('Y-m-d H:i:s')."' where in_id=".$in_id);
			ShowMessage("��ϲ����Ӧ�ñ༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}else{
			ShowMessage("�༭ʧ�ܣ�������Ա�����ڣ�","history.back(1);","infotitle3",3000,2);
		}
	}
?>