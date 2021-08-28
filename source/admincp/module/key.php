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
<title>��Կ����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
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
function make_key(_tid){
        if($('#_num').val() == "" || $('#_num').val() == 0){
            asyncbox.tips("��������Ϊ�գ�����д��", "wait", 1000);
            $('#_num').focus();
        }else{
            pop.up('no', '������Կ', '?iframe=make&tid=' + _tid + '&num=' + $('#_num').val(), '500px', '400px', '40px');
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'year':
		$state = SafeRequest("state","get");
		if(is_numeric($state)){
		        $sql = "select * from ".tname('key')." where in_tid=3 and in_state=$state order by in_id desc";
		}else{
		        $sql = "select * from ".tname('key')." where in_tid=3 order by in_id desc";
		}
		main($sql,20);
		break;
	case 'quarter':
		$state = SafeRequest("state","get");
		if(is_numeric($state)){
		        $sql = "select * from ".tname('key')." where in_tid=2 and in_state=$state order by in_id desc";
		}else{
		        $sql = "select * from ".tname('key')." where in_tid=2 order by in_id desc";
		}
		main($sql,20);
		break;
	default:
		$state = SafeRequest("state","get");
		if(is_numeric($state)){
		        $sql = "select * from ".tname('key')." where in_tid=1 and in_state=$state order by in_id desc";
		}else{
		        $sql = "select * from ".tname('key')." where in_tid=1 order by in_id desc";
		}
		main($sql,20);
		break;
	}
?>
</body>
</html>
<?php
function main($sql,$size){
	global $db,$action;
	$Arr=getpagerow($sql,$size);
	$result=$Arr[1];
	$count=$Arr[2];
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - �û� - ��Կ����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�&nbsp;&raquo;&nbsp;��Կ����';</script>
<div class="floattop"><div class="itemtitle"><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=key"><span>������Կ</span></a></li>
<?php if($action == 'quarter'){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=key&action=quarter"><span>������Կ</span></a></li>
<?php if($action == 'year'){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=key&action=year"><span>������Կ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><td>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<?php if($action == 'year'){ ?>
<option value="?iframe=key&action=year">����״̬</option>
<option value="?iframe=key&action=year&state=0"<?php if(isset($_GET['state']) && $_GET['state'] == 0){echo " selected";} ?>>δʹ��</option>
<option value="?iframe=key&action=year&state=1"<?php if(isset($_GET['state']) && $_GET['state'] == 1){echo " selected";} ?>>��ʹ��</option>
<?php }elseif($action == 'quarter'){ ?>
<option value="?iframe=key&action=quarter">����״̬</option>
<option value="?iframe=key&action=quarter&state=0"<?php if(isset($_GET['state']) && $_GET['state'] == 0){echo " selected";} ?>>δʹ��</option>
<option value="?iframe=key&action=quarter&state=1"<?php if(isset($_GET['state']) && $_GET['state'] == 1){echo " selected";} ?>>��ʹ��</option>
<?php }else{ ?>
<option value="?iframe=key">����״̬</option>
<option value="?iframe=key&state=0"<?php if(isset($_GET['state']) && $_GET['state'] == 0){echo " selected";} ?>>δʹ��</option>
<option value="?iframe=key&state=1"<?php if(isset($_GET['state']) && $_GET['state'] == 1){echo " selected";} ?>>��ʹ��</option>
<?php } ?>
</select>
������<input class="txt" type="text" id="_num" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
<input type="button" value="��������" class="btn" onclick="make_key(<?php echo $action ? $action == 'year' ? 3 : 2 : 1; ?>)">
</td></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��Կ����</th>
<th>��Կ����</th>
<th>��Կ״̬</th>
<th>����ʱ��</th>
</tr>
<?php if($count == 0){ ?>
<tr><td colspan="2" class="td27">û����Կ</td></tr>
<?php
}else{
while($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td><?php echo $row['in_id']; ?></td>
<td><?php echo $row['in_code']; ?></td>
<td><?php echo $row['in_tid'] > 1 ? $row['in_tid'] > 2 ? '������Կ' : '������Կ' : '������Կ'; ?></td>
<td><?php echo $row['in_state'] ? '<em class="lightnum">��ʹ��</em>' : 'δʹ��'; ?></td>
<td><?php if(date('Y-m-d', $row['in_time']) == date('Y-m-d')){echo '<em class="lightnum">'.date('Y-m-d H:i:s', $row['in_time']).'</em>';}else{echo date('Y-m-d', $row['in_time']);} ?></td>
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