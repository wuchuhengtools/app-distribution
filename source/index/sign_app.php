<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<?php
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
$row and IN_SIGN and $row['in_form'] == 'iOS' or exit(header('location:'.IN_PATH));
$row['in_sign'] or $GLOBALS['db']->query("delete from ".tname('signlog')." where in_aid=".$id);
$ssl = is_ssl() ? 'https://' : 'http://';
$file = $ssl.$_SERVER['HTTP_HOST'].IN_PATH.'data/attachment/'.str_replace('.png', '.ipa', $row['in_icon']);
$status = $GLOBALS['db']->getone("select in_status from ".tname('signlog')." where in_aid=".$id);
$sign = $status ? $status > 1 ? 2 : '<b id="_listen" style="color:#ec4242">正在进行签名，请稍等...</b>' : '未签名';
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET; ?>">
<title><?php echo $row['in_name']; ?> - 企业签名 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/sign.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'].'-'.time(); ?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword']; ?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid']; ?>;
var in_id = <?php echo $id; ?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize')); ?>;
var remote = {'open':'<?php echo IN_REMOTE; ?>','dir':'<?php echo IN_REMOTEPK; ?>','version':'<?php echo version_compare(PHP_VERSION, '5.5.0'); ?>'};
var oauth = {'api':'<?php echo IN_API; ?>','ssl':'<?php echo $ssl; ?>','site':'<?php echo $_SERVER['HTTP_HOST']; ?>','path':'<?php echo IN_PATH; ?>','ipa':'<?php echo str_replace('.png', '.ipa', $row['in_icon']); ?>','charset':'<?php echo IN_CHARSET; ?>','name':'<?php echo auth_codes($row['in_name']); ?>'};
<?php if($status && $status < 2){ ?>
setInterval('listen()', <?php echo IN_LISTEN; ?>);
<?php } ?>
layer.use('confirm-ext.js');
</script>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>">
				<div class="name"><span class="ng-binding"><?php echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span></div>
				<div class="email"><span class="ng-binding"><?php echo $GLOBALS['erduo_in_username']; ?></span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="<?php echo IN_PATH.'index.php/profile_info'; ?>" class="ng-binding">个人资料</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>">修改密码</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>">更新头像</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/logout'; ?>" class="ng-binding">退出</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href='<?php echo IN_PATH; ?>'"><?php echo $_SERVER['HTTP_HOST']; ?></span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="<?php echo IN_PATH.'index.php/home'; ?>" class="ng-binding">我的应用</a></div>
				<i class="icon-angle-right"></i>
				<div class="navbar-title secondary-title"><?php echo $row['in_name']; ?></div>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="ng-scope" id="dialog-uploadify" style="display:none">
	<div class="upload-modal-mask ng-scope"></div>
	<div class="upload-modal-container ng-scope">
		<div class="flip-container flip">
			<div class="modal-backend plane-ready upload-modal">
				<div class="btn-close" onclick="location.reload()"><i class="icon-cross"></i></div>
				<div class="plane-wrapper">
					<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
					</div>
				</div>
				<div class="progress-container">
					<p class="speed ng-binding" id="speed-uploadify"></p>
					<p class="turbo-upload"></p>
					<div class="progress">
						<div class="growing" style="width:0%"></div>
					</div>
				</div>
				<div class="redirect-tips ng-binding" style="display:none">正在解析应用，请稍等...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-app app-combo">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short"><?php echo getlink($row['in_id']); ?></span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding"><?php echo $row['in_hits']; ?></b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;<?php echo $row['in_bid']; ?></b></span>
				<span class="version ng-scope"><?php echo $row['in_form']; ?>&nbsp;<?php echo $row['in_mnvs']; ?>&nbsp;或者高版本</span>
			</div>
			<div class="actions">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="upload in" onclick="$('#upload_app').click()"><i class="icon-upload-cloud2"></i> 上传新版本</div>
				<a class="download ng-binding" href="<?php echo getlink($row['in_id']); ?>" target="_blank"><i class="icon-eye"></i> 预览</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding" href="<?php echo IN_PATH; ?>index.php/profile_app/<?php echo $row['in_id']; ?>"><i class="icon-file"></i>基本信息</a></li>
					<li><a class="ng-binding" style="border-left:1px solid" href="<?php echo IN_PATH; ?>index.php/each_app/<?php echo $row['in_id']; ?>"><i class="icon-combo"></i>应用合并</a></li>
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-device"></i>企业签名</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="ng-scope">
		<div class="page-tabcontent apps-app-info">
			<div class="middle-wrapper">
				<div class="app-info-form">
					<div class="field app-id">
						<div class="left-label ng-binding">签名期限</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php if($row['in_sign']){echo '<b style="color:#1aa79a">'.date('Y-m-d H:i:s', $row['in_sign']).'</b>';}else{echo '未开通';} ?></span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">补签名额</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php if($row['in_resign']){echo '<b style="color:#1aa79a">'.$row['in_resign'].'</b>';}else{echo $row['in_resign'];} ?></span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">签名指定</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">多文件以|隔开</span>
								<input type="text" class="form-control" placeholder="指定文件签名，默认留空！" id="in_replace">
							</div>
						</div>
					</div>
					<?php if(is_numeric($sign)){ ?>
					<div class="field app-short">
						<div class="left-label ng-binding">签名文件</div>
						<div class="value actions">
							<button class="save ng-binding" style="margin-right:260px;background-color:#1aa79a" onclick="location.href='<?php echo $file; ?>'">文件下载</button>
							<button class="save ng-binding" style="background-color:#1aa79a" onclick="window.open('<?php echo getlink($row['in_id']); ?>')">分发预览</button>
						</div>
					</div>
					<?php }else{ ?>
					<div class="field app-short">
						<div class="left-label ng-binding">签名文件</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $sign; ?></span>
							</div>
						</div>
					</div>
					<?php } ?>
					<hr>
					<div class="field app-short">
						<div class="left-label ng-binding">开通签名</div>
						<div class="value">
							<div class="apps-app-security">
								<div class="btn-invite-member" onclick="layer.prompt({title:'请输入签名密钥'},function(_key){purchase(_key)})">开通或续期</div>
							</div>
						</div>
					</div>
					<div class="field actions">
						<div class="value">
							<button class="save ng-binding" onclick="sign_confirm()">开始签名</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<div class="footer">
	<div class="footer-content">
		<ul class="list-inline list-unstyled navbar-footer">
			<li><a>Copyright &copy; <?php echo date('Y'); ?> <?php echo $_SERVER['HTTP_HOST']; ?> .All Rights Reserved.</a></li>
			<li><a href="mailto:<?php echo IN_MAIL; ?>">联系我们</a></li>
			<li><a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo IN_ICP; ?></a></li>
			<li><?php echo base64_decode(IN_STAT); ?></li>
		</ul>
		<div>
			<ul class="list-inline list-unstyled navbar-footer">
				<li>Powered by <a href="http://www.erduo.in/" target="_blank"><strong>Ear Music</strong></a> <span title="<?php echo IN_BUILD; ?>"><?php echo IN_VERSION; ?></span> &copy; 2011-<?php echo date('Y'); ?> <a href="http://www.earcms.com/" target="_blank">EarCMS</a> Inc.</li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>