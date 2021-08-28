<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<?php
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
$row or exit(header('location:'.IN_PATH));
$form = $row['in_form'] == 'Android' ? 'iOS' : 'Android';
$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_form='".$form."' and in_kid=0 and in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET; ?>">
<title><?php echo $row['in_name']; ?> - Ӧ�úϲ� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'].'-'.time(); ?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword']; ?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid']; ?>;
var in_id = <?php echo $id; ?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize')); ?>;
var remote = {'open':'<?php echo IN_REMOTE; ?>','dir':'<?php echo IN_REMOTEPK; ?>','version':'<?php echo version_compare(PHP_VERSION, '5.5.0'); ?>'};
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
						<li><a href="<?php echo IN_PATH.'index.php/profile_info'; ?>" class="ng-binding">��������</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>">�޸�����</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>">����ͷ��</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/logout'; ?>" class="ng-binding">�˳�</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href='<?php echo IN_PATH; ?>'"><?php echo $_SERVER['HTTP_HOST']; ?></span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="<?php echo IN_PATH.'index.php/home'; ?>" class="ng-binding">�ҵ�Ӧ��</a></div>
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
				<div class="redirect-tips ng-binding" style="display:none">���ڽ���Ӧ�ã����Ե�...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-app app-security">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short"><?php echo getlink($row['in_id']); ?></span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding"><?php echo $row['in_hits']; ?></b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;<?php echo $row['in_bid']; ?></b></span>
				<span class="version ng-scope"><?php echo $row['in_form']; ?>&nbsp;<?php echo $row['in_mnvs']; ?>&nbsp;���߸߰汾</span>
			</div>
			<div class="actions">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="upload in" onclick="$('#upload_app').click()"><i class="icon-upload-cloud2"></i> �ϴ��°汾</div>
				<a class="download ng-binding" href="<?php echo getlink($row['in_id']); ?>" target="_blank"><i class="icon-eye"></i> Ԥ��</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding" href="<?php echo IN_PATH; ?>index.php/profile_app/<?php echo $row['in_id']; ?>"><i class="icon-file"></i>������Ϣ</a></li>
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-combo"></i>Ӧ�úϲ�</a></li>
					<?php if(IN_SIGN && $row['in_form'] == 'iOS'){ ?>
					<li><a class="ng-binding" style="border-left:1px solid" href="<?php echo IN_PATH; ?>index.php/sign_app/<?php echo $row['in_id']; ?>"><i class="icon-device"></i>��ҵǩ��</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="ng-scope">
		<div class="apps-app-combo page-tabcontent ng-scope">
			<div class="middle-wrapper">
				<?php if($row['in_kid']){ ?>
				<div class="request-wrapper">
					<p class="lead text-center ng-scope">�Ѿ��� <b><?php echo getfield('app', 'in_name', 'in_id', $row['in_kid']); ?></b> �ϲ�</p>
					<table>
					<tr>
						<td><span class="type"><?php echo getfield('app', 'in_form', 'in_id', $row['in_kid']); ?></span></td>
						<td></td>
						<td><span class="type"><?php echo $row['in_form']; ?></span></td>
					</tr>
					<tr>
						<td><div class="icon"><img class="ng-isolate-scope" src="<?php echo geticon(getfield('app', 'in_icon', 'in_id', $row['in_kid'])); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo getfield('app', 'in_form', 'in_id', $row['in_kid']); ?>.png'"></div></td>
						<td><i class="icon-combo"></i></td>
						<td><div class="icon"><img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'"></div></td>
					</tr>
					<tr>
						<td colspan="3" class="actions"><a class="btn btn-link ng-scope" onclick="each_confirm()"><b>����ϲ�</b></a></td>
					</tr>
					</table>
				</div>
				<?php }else{ ?>
				<div class="icon-container text-center">
					<img width="128" class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'">
				</div>
				<div class="apps-list">
					<div class="known-apps" style="text-align:center">
						<p class="lead ng-binding"><b>ѡ�����е�Ӧ�ý��кϲ�</b></p>
						<div class="apps">
						<?php
							while($rows = $GLOBALS['db']->fetch_array($query)){
								echo '<div class="app ng-scope" onclick="each_add('.$rows['in_id'].')"><div class="icon">';
								echo '<img class="ng-isolate-scope" src="'.geticon($rows['in_icon']).'" onerror="this.src=\''.IN_PATH.'static/app/'.$rows['in_form'].'.png\'">';
								echo '</div><p class="ng-binding">'.$rows['in_name'].'</p></div>';
							}
						?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</section>
<div class="footer">
	<div class="footer-content">
		<ul class="list-inline list-unstyled navbar-footer">
			<li><a>Copyright &copy; <?php echo date('Y'); ?> <?php echo $_SERVER['HTTP_HOST']; ?> .All Rights Reserved.</a></li>
			<li><a href="mailto:<?php echo IN_MAIL; ?>">��ϵ����</a></li>
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