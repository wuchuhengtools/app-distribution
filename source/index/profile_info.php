<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>�������� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_info.css" rel="stylesheet">
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
<div class="user-info">
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
					<a href="<?php echo IN_PATH.'index.php/profile_info'; ?>" class="active"><span><i class="icon icon-user"></i></span>��������</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>"><span><i class="icon icon-lock"></i></span>�޸�����</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>"><span><i class="icon icon-badge"></i></span>����ͷ��</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-container">
		<div class="profile-form-wrap form-wrap">
			<div class="partials-user-profile">
				<div class="error-container" style="padding:15px;display:none" id="user_tips"></div>
				<form class="show_profile">
					<div class="control-group">
						<div class="control-label">
							<div class="input-group" style="border-bottom-color:transparent">
								<label class="input-label" for="user_null">����</label>
								<div class="show-value">
									<input type="text" value="<?php echo $GLOBALS['erduo_in_username']; ?>" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
								<label class="input-label" style="width:28px">�ֻ�</label>
								<div class="edit-value">
									<input class="value" style="cursor:auto" type="text" value="<?php echo $GLOBALS['erduo_in_mobile']; ?>" id="in_mobile" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
								<label class="input-label" style="width:28px">QQ</label>
								<div class="edit-value">
									<input class="value" style="cursor:auto" type="text" value="<?php echo $GLOBALS['erduo_in_qq']; ?>" id="in_qq" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
								<label class="input-label" style="width:28px">��˾</label>
								<div class="edit-value">
									<input class="value" style="cursor:auto" type="text" value="<?php echo $GLOBALS['erduo_in_firm']; ?>" id="in_firm">
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
								<label class="input-label" style="width:28px">ְλ</label>
								<div class="edit-value">
									<input class="value" style="cursor:auto" type="text" value="<?php echo $GLOBALS['erduo_in_job']; ?>" id="in_job">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group action">
						<input type="button" onclick="profile_info()" value="��������" class="btn btn-primary" style="width:390px;border-radius:4px;color:#FFF;border-color:#E2644C">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>