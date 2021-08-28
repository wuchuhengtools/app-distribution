<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php IN_SIGN or exit(header('location:'.IN_PATH)); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title>ǩ���۸� - <?php echo IN_NAME; ?></title>
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
			<i class="icon-brace-left"></i><span>��ҵǩ��</span><i class="icon-brace-right"></i>
		</div>
		<small>�Զ�ǩ��</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<h3>
		<div>ѡ����Կ����</div>
		<small style="color:#1aa79a"><?php if(!$GLOBALS['userlogined']){echo '����¼�������Կ����ʾ�ڴ˴�';}elseif(is_file(IN_ROOT.'./data/tmp/buy_key_'.$GLOBALS['erduo_in_userid'].'.txt')){echo '������������ԿΪ��<b style="color:#ec4242">'.file_get_contents(IN_ROOT.'./data/tmp/buy_key_'.$GLOBALS['erduo_in_userid'].'.txt').'</b>�����뼰ʱ�����ʹ��';}else{echo '������������Կ����ʾ�ڴ˴�';} ?></small>
		</h3>
		<div class="package-cards-wrap">
			<div class="package-cards" id="package_content">
				<div class="package-card">
					<div class="package-header">
						<h2>����</h2>
						<small>ǩ����Կ</small>
					</div>
					<div class="package-content">
						<div>��<?php echo IN_SIGN; ?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(1)">����</button>
					</div>
				</div>
				<div class="package-card active">
					<div class="package-header">
						<h2>����</h2>
						<small>ǩ����Կ</small>
					</div>
					<div class="package-content">
						<div class="package-badge">
							<div class="badge-wrap"><span>�Ƽ�</span><span class="arraw"></span></div>
						</div>
						<div>��<?php echo IN_SIGN * 3; ?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(2)">����</button>
					</div>
				</div>
				<div class="package-card">
					<div class="package-header">
						<h2>����</h2>
						<small>ǩ����Կ</small>
					</div>
					<div class="package-content">
						<div>��<?php echo IN_SIGN * 12; ?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(3)">����</button>
					</div>
				</div>
			</div>
		</div>
		<small>�������¸��������ϵ&nbsp;<a href="mailto:<?php echo IN_MAIL; ?>"><?php echo IN_MAIL; ?></a></small>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">��ǩ����</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_RESIGN; ?> ��/ÿ��</li>
						<li>��Կ����ʹ��</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">��Կ�۸�</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_SIGN; ?> Ԫ/ÿ��</li>
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
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$('.dialog-mask').hide(),$('.buy-confirm').hide()">��������</button><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.reload()">����ɹ������ϲ鿴</button>
	</div>
</div>
</body>
</html>