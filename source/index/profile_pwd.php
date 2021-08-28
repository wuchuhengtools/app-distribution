<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>�޸����� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_info.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_pwd.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript">var in_path = '<?php echo IN_PATH; ?>';</script>
</head>
<body>
<header>
<div class="brand">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 25 : 35; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<nav>
	<ul><li><a id="signoutLink" href="<?php echo IN_PATH.'index.php/home'; ?>">�ҵ�Ӧ��</a></li></ul>
</nav>
</header>
<div class="user-info form-container">
	<form class="avatar">
		<label><img src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>" width="120" height="120"></label>
	</form>
	<form class="auto-save-form">
		<div class="form-group floated">
			<span class="name"><?php echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span>
		</div>
	</form>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_info'; ?>"><span><i class="icon icon-user"></i></span>��������</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>" class="active"><span><i class="icon icon-lock"></i></span>�޸�����</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>"><span><i class="icon icon-badge"></i></span>����ͷ��</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-inner">
		<form class="edit_user">
			<div class="alert-warning"><ul style="text-align:left;display:none" id="user_tips"></ul></div>
			<div class="form-group">
				<input placeholder="��ǰ����" type="password" id="old_pwd">
			</div>
			<div class="form-group">
				<input placeholder="������" type="password" id="new_pwd">
			</div>
			<div class="form-group">
				<input placeholder="ȷ������" type="password" id="rnew_pwd">
			</div>
			<div class="form-group action">
				<input type="button" onclick="profile_pwd()" value="��������" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
</body>
</html>