<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title>���ע�� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/lib.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var home_link = '<?php echo IN_PATH.'index.php/home'; ?>';
function update_seccode(){
	document.getElementById('img_seccode').src = '<?php echo IN_PATH.'source/index/seccode.php'; ?>?' + Math.random();
}
</script>
</head>
<body class="page-sessions-new">
<div class="partials-brands">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 30 : 40; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<div class="form-container">
	<div class="form-behavior divider">
		<span>���ע��</span>
	</div>
	<div class="form-inner">
		<form class="form-float-label" onsubmit="reg();return false">
			<div class="alert-warning hidden" id="alert-warning"></div>
			<div class="form-group">
				<input class="form-control" autofocus placeholder="����" type="text" id="mail">
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="��������" type="password" id="pwd">
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="ȷ������" type="password" id="rpwd">
			</div>
			<div class="form-group form-group-sign-code">
				<input class="form-control" placeholder="��������֤��" type="text" id="seccode" maxlength="4">
				<img id="img_seccode" onclick="update_seccode()" style="margin:4px;border-radius:4px;cursor:pointer" src="<?php echo IN_PATH.'source/index/seccode.php'; ?>" height="40">
			</div>
			<div class="form-group action">
				<button type="submit" class="btn btn-block btn-primary">���ע��</button>
			</div>
		</form>
		<div class="help-section">
			<span class="btn-alternative"><a href="<?php echo IN_PATH.'index.php/login'; ?>">�����ʺţ�ȥ��¼</a></span>
		</div>
	</div>
</div>
</body>
</html>