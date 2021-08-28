<?php
include 'source/system/db.class.php';
include 'source/system/user.php';
$app = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$id = trim(isset($app[1]) ? $app[1] : NULL);
if(empty($id)){
	exit(header('location:'.IN_PATH));
}elseif(is_numeric($id)){
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
}else{
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_link='$id'");
}
$row or exit(header('location:'.IN_PATH));
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title><?php echo $row['in_name']; ?> - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/app/download.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/guide/swiper-3.3.1.min.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/guide/ab.css" rel="stylesheet">
<style type="text/css">.wechat_tip,.wechat_tip>i{position:absolute;right:10px}.wechat_tip{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;background:#3ab2a7;color:#fff;font-size:14px;font-weight:500;width:135px;height:60px;border-radius:10px;top:15px}.wechat_tip>i{top:-10px;width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-bottom:12px solid #3ab2a7}.mask img{max-width:100%;height:auto}</style>
<script src="<?php echo IN_PATH; ?>static/guide/zepto.min.js" type="text/javascript"></script>
<script src="<?php echo IN_PATH; ?>static/guide/swiper.jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function mobile_provision(){
	document.getElementById('actions').innerHTML = '<p>正在安装，请按 Home 键在桌面查看</p><button onclick="location.href=\'<?php echo IN_PATH; ?>static/app/app.mobileprovision\'">立即信任</button>';
}
<?php if(IN_MOBILEPROVISION==0){ ?>
function install_app(_link){
	if(!/android/.test(navigator.userAgent.toLowerCase())){
    		document.getElementById('actions').innerHTML = '<button style="min-width:43px;width:43px;padding:12px 0;border-top-color:transparent;border-left-color:transparent" class="loading">&nbsp;</button>';
    		setTimeout("mobile_provision()", 6000);
	}
	location.href = _link;
}
<?php }else{ ?>
function install_app(_link){
	if(/android/.test(navigator.userAgent.toLowerCase())){
    		location.href = _link;
	}else{
    		$('.mask').show();
    		$('.mask').html('<div class="alert-box"><div class="size-pic"><img id="mq1" src="<?php echo IN_PATH; ?>static/guide/mq1.jpg"><div class="device"><div class="swiper-container1"><div class="swiper-wrapper"><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq1.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq2.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq3.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq4.jpg"></div></div></div></div></div><div class="alert-btn"><div class="color-bar change top-bar"></div><div class="color-bar change buttom-bar"></div><a onclick="install_ing(\'' + _link + '\')" class="color-bar change text-bar">立即安装</a></div></div>');
	}
}
<?php } ?>
function install_ing(_link){
        location.href = _link;
        $(".text-bar")[0].innerHTML = "安装中";
        $(".change").show();
        $(".text-bar").attr("disabled", "true");
        $(".top-bar").css("width", "0.1%");
        timer = setTimeout(function() {
                $(".top-bar").css("width", "0.1%").animate({
                        width:"20%"
                }, 1e3, function() {
                        $("#mq1").hide();
                        $(".device").show();
                        var mySwiper = new Swiper(".swiper-container1", {
                                nextButton:".next_btn",
                                autoplay:3e3,
                                autoplayStopOnLast:true
                        });
                        $(".top-bar").css("width", "20%").animate({
                                width:"100%"
                        }, 15e3, function() {
                                $(".text-bar")[0].innerHTML = "立即信任";
                                $(".text-bar").removeAttr("disabled");
                                $(".text-bar").attr("href", "<?php echo IN_PATH; ?>static/app/app.mobileprovision");
                        });
                });
        }, 1e3);
}
</script>
</head>
<body>
<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){ ?>
<div class="wechat_tip_content"><div class="wechat_tip"><i class="triangle-up"></i>请点击右上角<br>在<?php echo strpos($_SERVER['HTTP_USER_AGENT'], 'Android') ? '浏览器' : 'Safari'; ?>中打开</div></div>
<?php }else{ ?>
<span class="pattern left"><img src="<?php echo IN_PATH; ?>static/app/left.png"></span>
<span class="pattern right"><img src="<?php echo IN_PATH; ?>static/app/right.png"></span>
<?php } ?>
<div class="out-container">
	<div class="main">
		<header>
		<div class="table-container">
			<div class="cell-container">
				<div class="app-brief">
					<div class="icon-container wrapper">
						<i class="icon-icon_path bg-path"></i>
						<span class="icon"><img src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'"></span>
						<span class="qrcode"><img src="<?php echo IN_PATH; ?>source/pack/weixin/qrcode.php?link=<?php echo getlink($row['in_id']); ?>"></span>
					</div>
					<h1 class="name wrapper"><span class="icon-warp"><i class="icon-<?php echo strtolower($row['in_form']); ?>"></i><?php echo $row['in_name']; ?></span></h1>
					<p class="scan-tips">扫描二维码下载<br />或用手机浏览器输入这个网址：<span class="text-black"><?php echo getlink($row['in_id']); ?></span></p>
					<div class="release-info">
						<p><?php echo $row['in_bsvs']; ?>（Build <?php echo $row['in_bvs']; ?>）- <?php echo $row['in_size']; ?></p>
						<p>更新于：<?php echo $row['in_addtime']; ?></p>
					</div>
					<?php if(checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){ ?>
					<div id="actions" class="actions">
						<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){ ?>
						<button type="button">不支持在微信内下载安装</button>
						<?php }else{ ?>
						<button onclick="install_app('<?php echo IN_PATH; ?>source/pack/upload/install/install.php?id=<?php echo $row['in_id']; ?>')"><?php echo getfield('user', 'in_points', 'in_userid', $row['in_uid']) ? '下载安装' : '开发者点数不足'; ?></button>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		</header>
		<?php if($row['in_kid']){ ?>
		<div class="per-type-info section">
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-<?php echo strtolower(getfield('app', 'in_form', 'in_id', $row['in_kid'])); ?>"></i>
					</p>
					<p class="version">
						关联版本：<?php echo getfield('app', 'in_bsvs', 'in_id', $row['in_kid']); ?>（Build <?php echo getfield('app', 'in_bvs', 'in_id', $row['in_kid']); ?>）
						文件大小：<?php echo getfield('app', 'in_size', 'in_id', $row['in_kid']); ?><br>
						更新于：<?php echo getfield('app', 'in_addtime', 'in_id', $row['in_kid']); ?>
					</p>
				</div>
			</div>
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-<?php echo strtolower($row['in_form']); ?>"></i>
					</p>
					<p class="version">
						当前版本：<?php echo $row['in_bsvs']; ?>（Build <?php echo $row['in_bvs']; ?>）
						文件大小：<?php echo $row['in_size']; ?><br>
						更新于：<?php echo $row['in_addtime']; ?>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="footer"><?php echo $_SERVER['HTTP_HOST']; ?> 是应用内测平台，请自行甄别应用风险！如有问题可通过邮件反馈。<a class="one-key-report" href="mailto:<?php echo IN_MAIL; ?>">联系我们</a></div>
	</div>
</div>
<div class="mask" style="display:none"></div>
</body>
</html>