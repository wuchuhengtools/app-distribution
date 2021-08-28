<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<link href="<?php echo IN_PATH; ?>static/index/home.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/home.js"></script>
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:40px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
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
<div class="super-container">
	<div class="section section-1 ready">
		<div class="beta-app-host">
			<pre class="typed-finish">
				BetaAppHost
				<br>
				{
				<br>
				     return "<?php echo $_SERVER['HTTP_HOST']; ?>"
				<br>
				}
			</pre>
			<b></b>
		</div>
		<div class="plane-wrapper" style="left:320px">
			<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
			<div class="rotate-container">
				<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
			</div>
		</div>
	</div>
	<div class="section section-2 ready">
		<div class="features">
			<div class="cols" style="width:480px">
				<div class="back">
				</div>
				<div class="front">
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-launch"></i>
									</div>
									<div class="title">
										�ڲ��й�
									</div>
									<div class="text">
										һ���ϴ�Ӧ�ã�ɨ���ά������
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-user-access"></i>
									</div>
									<div class="title">
										Ȩ�޿���
									</div>
									<div class="text">
										���ķ���Ȩ�޿��ƣ�������Ŷӳ�Ա
										<br>
										��ͬ�ϴ�������Ӧ��
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="cols" style="width:480px">
				<div class="back">
				</div>
				<div class="front">
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-plugin"></i>
									</div>
									<div class="title">
										���� API
									</div>
									<div class="text">
										ʹ�� <?php echo $_SERVER['HTTP_HOST']; ?> �� API �ӿڿ��Է���
										<br>
										Jenkins ���Զ����ɵ�ϵͳ
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-combo"></i>
									</div>
									<div class="title">
										Ӧ�úϲ�
									</div>
									<div class="text">
										ɨ��ͬһ����ά�룬�����豸�����Զ����ض�Ӧ�� iOS 
										<br>
										�� Android Ӧ�á�
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="cols" style="width:480px">
				<div class="back">
				</div>
				<div class="front">
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-console"></i>
									</div>
									<div class="title">
										�����й���
									</div>
									<div class="text">
										2sx-cli ����ͨ�������в鿴���ϴ������롢���Ӧ��
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-webhooks"></i>
									</div>
									<div class="title">
										Web Hooks
									</div>
									<div class="text">
										Ӧ�ø���ʱ�Ŷӳ�Ա���յ������ʼ������Web Hooks�ĵ�����ƽ̨Ҳ���и�����Ϣ���ѡ�����֧�� Slack�����ġ�BearyChat�����ơ��ٲ� IM�ȣ�
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-3">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="tools">
					<div class="title">
						Utility Tools
					</div>
					<div class="boxes-container">
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									�ò����û����ٻ�ȡ UDID �����͸�������
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-udid"></i>
									</div>
									<div class="side right">
										GET
										<br>
										UDID
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									��ȡ�ֻ���־�����ٶ�λ�޷���װ��ԭ��
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-filter"></i>
									</div>
									<div class="side right">
										LOG
										<br>
										GURU
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									��� SDK�����ʵ��Ӧ�õļ����¹���
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-update"></i>
									</div>
									<div class="side right">
										AUTO-
										<br>
										UPDATE
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									���ټ�Ȿ���� <?php echo $_SERVER['HTTP_HOST']; ?> ���ϴ������ٶ�
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-test-speed"></i>
									</div>
									<div class="side right">
										SPEED
										<br>
										TEST
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="section section-4">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="content-wrapper">
					<p class="title">
						What Our Users Say
					</p>
					<div class="users-wrapper">
						<div class="item jumei" data-item="jumei">
							<span class="logo"><i class="icon-logo-jumei"></i></span>
							<p class="words">
								�������Լ��ĺ���ȥ�ж���һ������ȫ����ݣ�<?php echo $_SERVER['HTTP_HOST']; ?> ��������Щ����ĸ���ӷ����ڲ��н�ţ��ڴ�Խ��Խ�ã�С����һ�����֧�� <?php echo $_SERVER['HTTP_HOST']; ?>��
							</p>
						</div>
						<div class="item jiecao" data-item="jiecao">
							<span class="logo"><i class="icon-logo-jiecao"></i></span>
							<p class="words">
								�ڲپ�ѡ�Ĺ�˾�ڲ����Ե�С��Χ�û�Ⱥ�ҶȲ��ԣ�<?php echo $_SERVER['HTTP_HOST']; ?> ���󷽱�����ǽ���˰�װ����������⣻��ȫ���ġ�������ݡ������࣡
							</p>
						</div>
						<div class="item jd" data-item="jd">
							<span class="logo"><i class="icon-logo-jd"></i></span>
							<p class="words">
								<?php echo $_SERVER['HTTP_HOST']; ?> ����˾����Ķ��ͻ���ÿ�ղ��Է��������⣬�������˿���򿪷����Ե��Ѷȣ�<?php echo $_SERVER['HTTP_HOST']; ?> ���ͣ�
							</p>
						</div>
						<div class="item ebaoyang" data-item="ebaoyang">
							<span class="logo"><i class="icon-logo-ebaoyang"></i></span>
							<p class="words">
								e ����һֱ���� <?php echo $_SERVER['HTTP_HOST']; ?> ���в����йַܷ���ϲ�� <?php echo $_SERVER['HTTP_HOST']; ?> �� UI ���û�������ƣ���ȷ����Ĳ�Ʒ��
							</p>
						</div>
						<div class="item xiachufang" data-item="xiachufang">
							<span class="logo"><i class="icon-logo-xiachufang"></i></span>
							<p class="words">
								<?php echo $_SERVER['HTTP_HOST']; ?> ���³���һ�������� UI �� UE ���¹��򣬽������߹���������༫�£����Ч�ʵ�ͬʱҲ����������Ŀ��
							</p>
						</div>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="section section-5">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="imfir">
					<div class="brand-animate">
						<span class="cursor"></span>
					</div>
					<div class="thumbsup-wrapper">
						<div class="brace-group">
							<i class="icon-brace-left"></i>
							<div class="brace-content">
								<i class="icon-thumbsup"></i><span class="face"><i class="icon-comma-eye left"></i><i class="icon-comma-eye right"></i><i class="icon-mouth"></i></span>
							</div>
							<i class="icon-brace-right"></i>
						</div>
						<p class="are-you-like">
							&nbsp;
						</p>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>