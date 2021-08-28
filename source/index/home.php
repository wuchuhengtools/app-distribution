<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<?php
	$ios = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from ".tname('app')." where in_form='iOS' and in_uid=".$GLOBALS['erduo_in_userid']));
	$android = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from ".tname('app')." where in_form='Android' and in_uid=".$GLOBALS['erduo_in_userid']));
	$home = explode('/', $_SERVER['PATH_INFO']);
	$string = isset($home[2]) ? $home[2] : NULL;
	if(empty($string)){
		$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
	}elseif(is_numeric($string)){
		$form = $string == 1 ? 'iOS' : 'Android';
		$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_form='".$form."' and in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
	}else{
		$key = SafeSql(trim(is_utf8($string)));
		$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_name like '%".$key."%' and in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
	}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET; ?>">
<title>我的应用 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var home_link = '<?php echo IN_PATH.'index.php/home'; ?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'].'-'.time(); ?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword']; ?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid']; ?>;
var in_id = 0;
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
<div class="page-apps ng-scope">
	<div class="middle-wrapper">
		<div class="filter-group">
			<div class="filter-set">
				<span class="filter<?php if($string == 1){echo ' active';} ?>" onclick="location.href='<?php echo IN_PATH.'index.php/home/1'; ?>'"><i class="icon-apple"></i></span>
				<i class="split"></i>
				<span class="filter<?php if($string == 2){echo ' active';} ?>" onclick="location.href='<?php echo IN_PATH.'index.php/home/2'; ?>'"><i class="icon-android"></i></span>
			</div>
			<div class="search-form">
				<i class="icon-search" onclick="s_earch()"></i>
				<input type="text" id="k_eyword" onkeydown="if(event.keyCode==13){s_earch()}" placeholder="输入名称搜索">
			</div>
			<div class="surplus-wrap">
				<div class="surplus">
					<div class="surplus-card">
						<div class="name"><span>iOS应用</span></div>
						<div class="value"><span class="ng-binding"><?php echo $ios; ?></span></div>
					</div>
					<div class="surplus-card">
						<div class="name"><span>Android应用</span></div>
						<div class="value"><span class="ng-binding"><?php echo $android; ?></span></div>
					</div>
					<div class="surplus-card">
						<div class="name"><span>剩余下载点数</span></div>
						<div class="value"><span class="ng-binding"><?php echo $GLOBALS['erduo_in_points']; ?></span></div>
					</div>
					<div class="surplus-card">
						<div class="name">购买点数包</div>
						<button type="button" onclick="location.href='<?php echo IN_PATH.'index.php/install'; ?>'" class="btn action"><i class="icon icon-cart"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="middle-wrapper container-fluid">
		<div class="apps row">
			<upload-card class="components-upload-card col-xs-4 col-sm-4 col-md-4 app-animator">
			<div class="card text-center">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="dashed-space" onclick="$('#upload_app').click()">
					<table><tbody><tr><td>
						<i class="icon-upload-cloud2"></i>
						<div class="text drag-state"><span>点击这里上传应用</span><span></span></div>
					</td></tr></tbody></table>
				</div>
			</div>
			</upload-card>
			<?php
				while($row = $GLOBALS['db']->fetch_array($query)){
					$class = $row['in_form'] == 'iOS' ? 'icon-apple' : 'icon-android';
					echo '<div class="col-xs-4 col-sm-4 col-md-4 app-animator ng-scope"><div class="card app card-ios">';
					echo '<i class="type-icon '.$class.'"></i><div class="type-mark"></div>';
					echo '<a class="appicon" href="'.IN_PATH.'index.php/each_app/'.$row['in_id'].'"><img class="icon ng-isolate-scope" width="100" height="100" src="'.geticon($row['in_icon']).'" onerror="this.src=\''.IN_PATH.'static/app/'.$row['in_form'].'.png\'"></a>';
					if($row['in_kid']){
						echo '<div class="combo-info ng-scope"><i class="icon-combo"></i><img class="icon ng-isolate-scope" width="45" height="45" src="'.geticon(getfield('app', 'in_icon', 'in_id', $row['in_kid'])).'" onerror="this.src=\''.IN_PATH.'static/app/'.getfield('app', 'in_form', 'in_id', $row['in_kid']).'.png\'"></div>';
					}
					echo '<br><p class="appname"><i class="icon-owner"></i><span class="ng-binding">'.$row['in_name'].'</span></p>';
					echo '<table><tbody>';
					if(IN_SIGN && $row['in_form'] == 'iOS'){
						echo '<tr><td class="ng-binding">签名期限：</td><td><span class="ng-binding"><a href="'.IN_PATH.'index.php/sign_app/'.$row['in_id'].'">'.($row['in_sign'] ? date('Y-m-d H:i:s', $row['in_sign']) : '未开通').'</a></span></td></tr>';
					}else{
						echo '<tr><td class="ng-binding">应用大小：</td><td><span class="ng-binding">'.$row['in_size'].'</span></td></tr>';
					}
					echo '<tr><td class="ng-binding">应用平台：</td><td><span class="ng-binding">'.$row['in_form'].'</span></td></tr>';
					echo '<tr><td class="ng-binding">应用标识：</td><td><span class="ng-binding">'.$row['in_bid'].'</span></td></tr>';
					echo '<tr><td class="ng-binding">最新版本：</td><td><span class="ng-binding">'.$row['in_bsvs'].'（Build '.$row['in_bvs'].'）</span></td></tr>';
					echo '</tbody></table>';
					echo '<div class="action"><a class="ng-binding" href="'.IN_PATH.'index.php/profile_app/'.$row['in_id'].'"><i class="icon-pen"></i> 管理</a><a href="'.getlink($row['in_id']).'" target="_blank" class="ng-binding"><i class="icon-eye"></i> 预览</a><button class="btn btn-remove ng-scope" onclick="del_app('.$row['in_id'].', 1)"><i class="icon icon-trash"></i></button></div>';
					echo '</div></div>';
				}
			?>
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