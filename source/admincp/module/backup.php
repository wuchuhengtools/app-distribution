<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$action=SafeRequest("action","get");
switch($action){
	case 'backup':
		mainjump();
		delold();
		backup();
		break;
	case 'backupnext':
		mainjump();
		backupnext();
		break;
	case 'restore':
		mainjump();
		restore();
		break;
	case 'delsql':
		mainjump();
		delsql();
		break;
	case 'inzip':
		mainjump();
		inzip();
		break;
	case 'unzip':
		mainjump();
		unzip();
		break;
	case 'delzip':
		mainjump();
		delzip();
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
<title>վ�㱸��</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ���� - վ�㱸��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='����&nbsp;&raquo;&nbsp;վ�㱸��';</script>
<div class="floattop"><div class="itemtitle"><h3>վ�㱸��</h3></div></div><div class="floattopempty"></div>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">��������</th></tr>
</table>
<table class="tb tb2">
<tr><td>�־��ݴ�С��<input type="text" class="txt" name="size" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">Ĭ��2048KB</td><td><input type="submit" class="btn" value="��ʼ��������" onclick="form.action='?iframe=backup&action=backup'" /></td><td><input type="submit" class="btn" value="��ԭ����" onclick="form.action='?iframe=backup&action=restore'" /></td><td><?php echo checksql(); ?></td></tr>
</table>
<table class="tb tb2">
<tr><th class="partition">�����ļ�</th></tr>
</table>
<table class="tb tb2">
<tr><td>ѹ����ѹĿ¼��<input type="text" class="txt" name="dir">����Ϊ��Ŀ¼</td><td><input type="submit" class="btn" value="��ʼѹ���ļ�" onclick="form.action='?iframe=backup&action=inzip'" /></td><td><input type="submit" class="btn" value="��ѹ�ļ�" onclick="form.action='?iframe=backup&action=unzip'" /></td><td><?php echo checkzip(); ?></td></tr>
</table>
</form>
<h3>Ear Music ��ʾ</h3>
<div class="infobox"><iframe name="iframe" frameborder="0" width="100%" height="100%" src="?iframe=backup&action=mainjump"></iframe></div>
</div>
</body>
</html>
<?php
} function backup(){
	global $db;
	$size = !empty($_POST['size']) ? SafeRequest("size","post") : '2048';
	$result = $db->query('SHOW TABLES FROM '.IN_DBNAME);
	if($result){
		$dbfile = 'data/backup/table_'.substr(md5(time().mt_rand(1000, 5000)), 0, 16).'.sql';
		$fp = fopen($dbfile, 'w');
		while($row = $db->fetch_row($result)){
			$prefix = explode('_', $row[0]);
			if($prefix[0] == str_replace('_', '', IN_DBTABLE)){
        			fwrite($fp, "\r\nDROP TABLE IF EXISTS `$row[0]`;\r\n\r\n");
				$sql = "SHOW CREATE TABLE `$row[0]`";
				$Struct = $db->getall($sql);
				if($Struct){
					$data = str_replace("\n","\r\n",$Struct[0]['Create Table']).";\r\n";
					fwrite($fp, $data);
					echo "�������ݱ�ṹ <span style=\"color:#090\">".$row[0]."</span> ... �ɹ�<br />";
				}else{
					echo "�������ݱ�ṹ <span style=\"color:#C00\">".$row[0]."</span> ... ʧ��<br />";
				}
			}
		}
		fclose($fp);
		echo "<br /><span style=\"color:#09C\">���ݱ�ṹ������ϣ�����������������...</span><script type=\"text/javascript\">setTimeout(\"location.href='?iframe=backup&action=backupnext&size=".$size."';\", 3000);</script>";
	}
} function backupnext(){
	global $db;
	$size = SafeRequest("size","get");
	$tableresult = $db->query('SHOW TABLES FROM '.IN_DBNAME);
	if($tableresult){
		$bakstr = '';
		$batch = 0;
		while($tablerow = $db->fetch_row($tableresult)){
			$prefix = explode('_', $tablerow[0]);
			if($prefix[0] == str_replace('_', '', IN_DBTABLE)){
				$intable = "INSERT INTO `$tablerow[0]` VALUES(";
				$fieldresult = $db->query("SHOW FULL COLUMNS FROM $tablerow[0]");
				$i = 0;
				if($fieldresult){
	  				while($fieldrow = $db->fetch_array($fieldresult)){
		 		 		$fs[$i] = $fieldrow['Field'];
						$i++;
					}
					$fsd = $i - 1;
					$sql = "select * from `$tablerow[0]`";
					$result = $db->getall($sql);
					for($j = 0; $j < count($result); $j++){
						$line = $intable;
						for($k = 0; $k <= $fsd; $k++){
							if($k < $fsd){
								$line .= "'".$db->escape_field($result[$j][$fs[$k]])."',";
							}else{
								$line .= "'".$db->escape_field($result[$j][$fs[$k]])."');\r\n";
							}
						}
						$bakstr .= $line;
						if(strlen($bakstr) > $size * 1024){
							$batch = $batch + 1;
							$dbfile = 'data/backup/data_'.$batch.'-'.substr(md5(time().mt_rand(1000, 5000)), 0, 16).'.sql';
							$fp = fopen($dbfile, 'w');
							fwrite($fp, preg_replace("/'\);\r?\n\]/", "');", $bakstr."]"));
							fclose($fp);
							echo "�־��ļ� <span style=\"color:#090\">".$dbfile."</span> ���ݳɹ�...<br />";
							$bakstr = '';
						}
					}
				}
			}
		}
		if(!empty($bakstr) && strlen($bakstr) < $size * 1024){
			$dbfile = 'data/backup/data_0-'.substr(md5(time().mt_rand(1000, 5000)), 0, 16).'.sql';
			$fp = fopen($dbfile, 'w');
			fwrite($fp, preg_replace("/'\);\r?\n\]/", "');", $bakstr."]"));
			fclose($fp);
			echo "�־��ļ� <span style=\"color:#090\">".$dbfile."</span> ���ݳɹ�...<br />";
		}
		echo "<br /><span style=\"color:#090\">��ϲ�����ݿ��Ѿ�ȫ��������ɣ�</span>";
	}
} function delold(){
	fwrite(fopen('data/backup/bak.log', 'w'), date('Y-m-d H:i:s'));
	$d = 'data/backup/';
	if(is_dir($d)){
	  	$dh = opendir($d);
 		while(false !== ($file = readdir($dh))){
   			if($file != "." && $file != ".."){
      				$fullpath = $d.$file;
      				if(!is_dir($fullpath) && stristr($file, '.sql')){
         		 		unlink($fullpath);
     				}
			}
   		}
   		closedir($dh);
	}
} function restore(){
	global $db;
	if(is_file('data/backup/bak.log')){
		$d = 'data/backup/';
		if(is_dir($d)){
			$dh = opendir($d);
			while(false !== ($file = readdir($dh))){
				if($file != "." && $file != ".."){
					$fullpath = $d.$file;
					if(!is_dir($fullpath) && stristr($file, 'table_')){
						$table_str = @file_get_contents($fullpath);
						$tablearr = explode(';', $table_str);
						for($i = 0; $i < count($tablearr) - 1; $i++){
							$db->query($tablearr[$i]);
						}
					}elseif(!is_dir($fullpath) && stristr($file, 'data_')){
						$filearr[] = $fullpath;
					}
				}
			}
			closedir($dh);
			for($i = 0; $i < count($filearr); $i++){
				$data_str = @file_get_contents(trim($filearr[$i]));
				$dataarr = explode("\n", $data_str);
				for($j = 0; $j < count($dataarr); $j++){
					$db->query($dataarr[$j]);
				}
				echo "�ɹ���ԭ <span style=\"color:#090\">".$j."</span> ������...<br />";
			}
			echo "<br /><span style=\"color:#090\">��ϲ�����ݿ��Ѿ�ȫ����ԭ��ɣ�</span>";
		}
	}else{
		echo "<span style=\"color:#C00\">û���ҵ������ļ������ȱ������ݣ�</span>";
	}
} function checksql(){
        if(is_file('data/backup/bak.log')){
                echo "<input type=\"submit\" class=\"btn\" value=\"ɾ������\" onclick=\"form.action='?iframe=backup&action=delsql'\" />";
        }else{
		echo "<input type=\"button\" class=\"btn\" value=\"���ޱ���\" disabled=\"disabled\" />";
        }
} function delsql(){
	@unlink('data/backup/bak.log');
	$d = 'data/backup/';
	if(is_dir($d)){
	  	$dh = opendir($d);
 		while(false !== ($file = readdir($dh))){
   			if($file != "." && $file != ".."){
      				$fullpath = $d.$file;
      				if(!is_dir($fullpath) && stristr($file, '.sql')){
         		 		unlink($fullpath);
     				}
			}
   		}
   		closedir($dh);
	}
        echo "<span style=\"color:#090\">�����ļ���ɾ����</span>";
} function inzip(){
        include_once 'source/pack/zip/zip.php';
	$dir = !empty($_POST['dir']) ? SafeRequest("dir","post") : IN_ROOT;
        $inzip = 'data/backup/bak.zip';
        @unlink($inzip);
        $zip = new PclZip($inzip);
        if(($list = $zip->create($dir, PCLZIP_OPT_REMOVE_PATH, $dir)) == 0){
                echo "<span style=\"color:#C00\">".$zip->errorInfo(true)."</span>";
        }else{
                echo "<span style=\"color:#090\">��ϲ���ļ��Ѿ�ȫ��ѹ����ɣ�</span><a href=\"".$inzip."\">��������</a>";
        }
} function unzip(){
        include_once 'source/pack/zip/zip.php';
	$dir = !empty($_POST['dir']) ? SafeRequest("dir","post") : IN_ROOT;
        $unzip = 'data/backup/bak.zip';
        if(is_file($unzip)){
                $zip = new PclZip($unzip);
                if(($list = $zip->listContent()) == 0){
                        exit("<span style=\"color:#C00\">".$zip->errorInfo(true)."</span>");
                }
                $zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_REPLACE_NEWER);
                echo "<span style=\"color:#090\">��ϲ���ļ��Ѿ�ȫ����ѹ��ɣ�</span>";
        }else{
		echo "<span style=\"color:#C00\">û���ҵ�ָ����ѹ���������ȱ����ļ���</span>";
        }
} function checkzip(){
        if(is_file('data/backup/bak.zip')){
                echo "<input type=\"submit\" class=\"btn\" value=\"ɾ������\" onclick=\"form.action='?iframe=backup&action=delzip'\" />";
        }else{
		echo "<input type=\"button\" class=\"btn\" value=\"���ޱ���\" disabled=\"disabled\" />";
        }
} function delzip(){
        @unlink('data/backup/bak.zip');
        echo "<span style=\"color:#090\">ָ����ѹ������ɾ����</span>";
}
?>