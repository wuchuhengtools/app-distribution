<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(2);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��չ����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
function change(type){
        if(type==1){
            $('remote').style.display='';
        }else if(type==2){
            $('remote').style.display='none';
        }
}
</script>
</head>
<body>
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
</body>
</html>
<?php function main(){ ?>
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ȫ�� - ��չ����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;��չ����';</script>
<form method="post" action="?iframe=config_extend&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop"><div class="itemtitle"><h3>��չ����</h3><ul class="tab1">
<li><a href="?iframe=config"><span>ȫ������</span></a></li>
<li class="current"><a href="?iframe=config_extend"><span>��չ����</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">΢��֧��</th></tr>
<tr><td colspan="2" class="td27">�̻���:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXMCHID; ?>" name="IN_WXMCHID"></td><td class="vtop tips2">΢��֧���̻��ţ�΢�����ͨ���ʼ��ڻ�ȡ</td></tr>
<tr><td colspan="2" class="td27">API ��Կ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXKEY; ?>" name="IN_WXKEY"></td><td class="vtop tips2">��¼΢��֧���̻�ƽ̨���ʻ�����-���밲ȫ-API��ȫ</td></tr>
<tr><td colspan="2" class="td27">Ӧ�� ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXAPPID; ?>" name="IN_WXAPPID"></td><td class="vtop tips2">΢�ź�̨���������ģ���ȡAppId</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">Ӧ�÷ַ�</th></tr>
<tr><td colspan="2" class="td27">��ֵ����:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RMBPOINTS; ?>" name="IN_RMBPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���ص���/ÿԪ</td></tr>
<tr><td colspan="2" class="td27">ÿ�յ�¼:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINPOINTS; ?>" name="IN_LOGINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���ص���</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��ҵǩ��</th></tr>
<tr><td colspan="2" class="td27">ÿ�¼۸�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGN; ?>" name="IN_SIGN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��λ��Ԫ������Ϊ0�ɹر�ǩ������</td></tr>
<tr><td colspan="2" class="td27">ÿ�²�ǩ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RESIGN; ?>" name="IN_RESIGN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">���Ƶ��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LISTEN; ?>" name="IN_LISTEN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��λ�����룬����״����̫���õ�վ�㽨���ֵ����</td></tr>
<tr><td colspan="2" class="td27">�ӿڵ�ַ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_API; ?>" name="IN_API"></td><td class="vtop tips2">ǩ��ʱҪ����Ľӿڵ�ַ</td></tr>
<tr><td colspan="2" class="td27">�ӿ��ܳ�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SECRET; ?>" name="IN_SECRET"></td><td class="vtop tips2">ǩ��ʱҪ��֤�Ľӿ��ܳ�</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">Զ���ϴ�</th></tr>
<tr><td colspan="2" class="td27">�ƴ洢:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_REMOTE==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="1" onclick="change(1);"<?php if(IN_REMOTE==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_REMOTE==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="0" onclick="change(2);"<?php if(IN_REMOTE==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop tips2">PHP5.5���°汾��֧���ϴ�������</td></tr>
<tbody class="sub" id="remote"<?php if(IN_REMOTE<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">�ϴ���ʶ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEPK; ?>" name="IN_REMOTEPK"></td><td class="vtop tips2">�ƴ洢����չĿ¼����������oss��qiniu</td></tr>
<tr><td colspan="2" class="td27">��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEDK; ?>" name="IN_REMOTEDK"></td><td class="vtop tips2">�ԡ�<em class="lightnum">http://</em>����ͷ����<em class="lightnum">/</em>����β</td></tr>
<tr><td colspan="2" class="td27">Bucket:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEBK; ?>" name="IN_REMOTEBK"></td><td class="vtop tips2">�ƴ洢�Ŀռ�����</td></tr>
<tr><td colspan="2" class="td27">AccessKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEAK; ?>" name="IN_REMOTEAK"></td><td class="vtop tips2">�ƴ洢��ͨ����Կ</td></tr>
<tr><td colspan="2" class="td27">SecretKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTESK; ?>" name="IN_REMOTESK"></td><td class="vtop tips2">�ƴ洢��ͨ����Կ</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">������ַ</th></tr>
<tr><td colspan="2" class="td27">α��̬:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REWRITE">
<option value="0">����</option>
<option value="1"<?php if(IN_REWRITE==1){echo " selected";} ?>>����</option>
</select>
</td><td class="vtop tips2">������ķ�������֧�� Rewrite����ѡ�񡰽��á�</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��������</th></tr>
<tr><td colspan="2" class="td27">���ַ�ʽ:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_MOBILEPROVISION">
<option value="0">Ĭ�Ϸ�ʽ</option>
<option value="1"<?php if(IN_MOBILEPROVISION==1){echo " selected";} ?>>������ʽ</option>
</select>
</td><td class="vtop tips2">��װiOSӦ��ʱ���������εĳ��ַ�ʽ</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">һ����ͼ</th></tr>
<tr><td colspan="2" class="td27">�����ʽ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_EXT; ?>" name="IN_EXT"></td><td class="vtop tips2">���ø�ʽ��40*40|60*60|58*58|87*87|80*80|120*120|120*120|180*180</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash', 1)){ShowMessage("����·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_WXMCHID', '(.*?)'/", "'IN_WXMCHID', '".SafeRequest("IN_WXMCHID","post")."'", $str);
$str=preg_replace("/'IN_WXKEY', '(.*?)'/", "'IN_WXKEY', '".SafeRequest("IN_WXKEY","post")."'", $str);
$str=preg_replace("/'IN_WXAPPID', '(.*?)'/", "'IN_WXAPPID', '".SafeRequest("IN_WXAPPID","post")."'", $str);
$str=preg_replace("/'IN_RMBPOINTS', '(.*?)'/", "'IN_RMBPOINTS', '".SafeRequest("IN_RMBPOINTS","post")."'", $str);
$str=preg_replace("/'IN_LOGINPOINTS', '(.*?)'/", "'IN_LOGINPOINTS', '".SafeRequest("IN_LOGINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SIGN', '(.*?)'/", "'IN_SIGN', '".SafeRequest("IN_SIGN","post")."'", $str);
$str=preg_replace("/'IN_RESIGN', '(.*?)'/", "'IN_RESIGN', '".SafeRequest("IN_RESIGN","post")."'", $str);
$str=preg_replace("/'IN_LISTEN', '(.*?)'/", "'IN_LISTEN', '".SafeRequest("IN_LISTEN","post")."'", $str);
$str=preg_replace("/'IN_API', '(.*?)'/", "'IN_API', '".SafeRequest("IN_API","post")."'", $str);
$str=preg_replace("/'IN_SECRET', '(.*?)'/", "'IN_SECRET', '".SafeRequest("IN_SECRET","post")."'", $str);
$str=preg_replace("/'IN_REMOTE', '(.*?)'/", "'IN_REMOTE', '".SafeRequest("IN_REMOTE","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPK', '(.*?)'/", "'IN_REMOTEPK', '".SafeRequest("IN_REMOTEPK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEDK', '(.*?)'/", "'IN_REMOTEDK', '".SafeRequest("IN_REMOTEDK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEBK', '(.*?)'/", "'IN_REMOTEBK', '".SafeRequest("IN_REMOTEBK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEAK', '(.*?)'/", "'IN_REMOTEAK', '".SafeRequest("IN_REMOTEAK","post")."'", $str);
$str=preg_replace("/'IN_REMOTESK', '(.*?)'/", "'IN_REMOTESK', '".SafeRequest("IN_REMOTESK","post")."'", $str);
$str=preg_replace("/'IN_REWRITE', '(.*?)'/", "'IN_REWRITE', '".SafeRequest("IN_REWRITE","post")."'", $str);
$str=preg_replace("/'IN_MOBILEPROVISION', '(.*?)'/", "'IN_MOBILEPROVISION', '".SafeRequest("IN_MOBILEPROVISION","post")."'", $str);
$str=preg_replace("/'IN_EXT', '(.*?)'/", "'IN_EXT', '".SafeRequest("IN_EXT","post")."'", $str);
if(!$fp = fopen('source/system/config.inc.php', 'w')){ShowMessage("����ʧ�ܣ��ļ�{source/system/config.inc.php}û��д��Ȩ�ޣ�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("��ϲ�������ñ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>