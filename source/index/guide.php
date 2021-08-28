<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php
	$array = '';
	for($i = 0; $i < strlen($_SERVER['HTTP_HOST']); $i++){
		$str = substr($_SERVER['HTTP_HOST'], $i, 1);
		$arr[] = '"'.$str.'"';
		$array .= $str == '.' ? '<i class="icon-comma trans"></i>' : '<i class="icon-" style="font-style:normal;font-size:100px;font-weight:bold">'.$str.'</i>';
	}
	$letter_doodle = implode(',', $arr);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title><?php echo IN_NAME; ?> - App�йܷ���ַ�ƽ̨|��׿Ӧ���й�|iOS�ַ�|ipa��ҵǩ��</title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/analytics.js"></script>
<script type="text/javascript">
var startTime = new Date();
var reg_link = '<?php echo IN_PATH.'index.php/reg'; ?>';
var letter_doodle = ["B","e","t","a","A","p","p","H","o","s","t","<br>","{","<br>","     ","r","e","t","u","r","n"," ",'"',<?php echo $letter_doodle; ?>,'"',"<br>","}"];
var end_letter_doodle = '<?php echo $array; ?>';
</script>
</head>
<body>
<div id="loadingCover" onclick="location.reload()" class="loading-cover" style="cursor:pointer">
	<span class="circle prepare"><img src="<?php echo IN_PATH; ?>static/index/loading-Home.gif"></span>
</div>
<?php
if(checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){
	include 'source/index/index_mobile.php';
}else{
	include 'source/index/index_pc.php';
}
?>
</body>
</html>