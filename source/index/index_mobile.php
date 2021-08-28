<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<link href="<?php echo IN_PATH; ?>static/index/responsive.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/resp_home.js"></script>
<header>
<div class="pdding-box">
	<h1 class="brand"><a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:30px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a></h1>
	<nav><i class="icon-menu"></i></nav>
</div>
</header>
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
<div id="touchContainer" class="super-container">
	<section id="section-1" class="section-1 ready animate-in" data-swipe-direction="u" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="plane-wrapper">
			<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
			<div class="rotate-container">
				<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
			</div>
		</div>
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
	</div>
	</section>
	<section id="section-2" class="section-2 ready" data-swipe-direction="lrud" data-items-container="content-container" active-item="1" style="height:736px">
	<div class="content-container front" style="height:736px">
		<div class="item features-item current" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-launch"></i>
					</div>
					<div class="feature-name">
						�ڲ��й�
					</div>
					<div class="feature-desc">
						һ���ϴ�Ӧ�ã�ɨ���ά������
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item next" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-combo"></i>
					</div>
					<div class="feature-name">
						Ӧ�úϲ�
					</div>
					<div class="feature-desc">
						ɨ��ͬһ����ά�룬�����豸�����Զ����ض�Ӧ�� iOS 
						<br>
						�� Android Ӧ�á�
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-console"></i>
					</div>
					<div class="feature-name">
						�����й���
					</div>
					<div class="feature-desc">
						2sx-cli ����ͨ�������в鿴���ϴ������롢���Ӧ��
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-user-access"></i>
					</div>
					<div class="feature-name">
						Ȩ�޿���
					</div>
					<div class="feature-desc">
						���ķ���Ȩ�޿��ƣ�������Ŷӳ�Ա
						<br>
						��ͬ�ϴ�������Ӧ��
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-plugin"></i>
					</div>
					<div class="feature-name">
						���� API
					</div>
					<div class="feature-desc">
						ʹ�� <?php echo $_SERVER['HTTP_HOST']; ?> �� API �ӿڿ��Է���
						<br>
						Jenkins ���Զ����ɵ�ϵͳ
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item prev" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-webhooks"></i>
					</div>
					<div class="feature-name">
						Web Hooks
					</div>
					<div class="feature-desc">
						Ӧ�ø���ʱ�Ŷӳ�Ա���յ������ʼ������Web Hooks�ĵ�����ƽ̨Ҳ���и�����Ϣ���ѡ�����֧�� Slack�����ġ�BearyChat�����ơ��ٲ� IM�ȣ�
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	<div class="content-container back" style="height:736px">
	</div>
	</section>
	<section id="section-3" class="section-3" data-swipe-direction="lrud" data-items-container="content-container" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="item utils-item current">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							�ò����û����ٻ�ȡ UDID �����͸�������
						</div>
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
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item next">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							��ȡ�ֻ���־�����ٶ�λ�޷���װ��ԭ��
						</div>
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
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							��� SDK�����ʵ��Ӧ�õļ����¹���
						</div>
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
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item prev">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							���ټ�Ȿ���� <?php echo $_SERVER['HTTP_HOST']; ?> ���ϴ������ٶ�
						</div>
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
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
	</section>
	<section id="section-4" class="section-4" data-swipe-direction="lrud" data-items-container="content-container" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="item users-item current">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jumei"></i>
					</div>
					<div class="words">
						�������Լ��ĺ���ȥ�ж���һ������ȫ����ݣ�<?php echo $_SERVER['HTTP_HOST']; ?> ��������Щ����ĸ���ӷ����ڲ��н�ţ��ڴ�Խ��Խ�ã�С����һ�����֧�� <?php echo $_SERVER['HTTP_HOST']; ?>��
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item next">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jiecao"></i>
					</div>
					<div class="words">
						�ڲپ�ѡ�Ĺ�˾�ڲ����Ե�С��Χ�û�Ⱥ�ҶȲ��ԣ�<?php echo $_SERVER['HTTP_HOST']; ?> ���󷽱�����ǽ���˰�װ����������⣻��ȫ���ġ�������ݡ������࣡
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jd"></i>
					</div>
					<div class="words">
						<?php echo $_SERVER['HTTP_HOST']; ?> ����˾����Ķ��ͻ���ÿ�ղ��Է��������⣬�������˿���򿪷����Ե��Ѷȣ�<?php echo $_SERVER['HTTP_HOST']; ?> ���ͣ�
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-ebaoyang"></i>
					</div>
					<div class="words">
						e ����һֱ���� <?php echo $_SERVER['HTTP_HOST']; ?> ���в����йַܷ���ϲ�� <?php echo $_SERVER['HTTP_HOST']; ?> �� UI ���û�������ƣ���ȷ����Ĳ�Ʒ��
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-xiachufang"></i>
					</div>
					<div class="words">
						<?php echo $_SERVER['HTTP_HOST']; ?> ���³���һ�������� UI �� UE ���¹��򣬽������߹���������༫�£����Ч�ʵ�ͬʱҲ����������Ŀ��
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	</section>
	<section id="section-5" class="section-5" data-swipe-direction="d" style="height:736px">
	<div class="content-container" style="height:736px">
		<table>
		<tbody>
		<tr>
			<td>
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
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	</section>
</div>