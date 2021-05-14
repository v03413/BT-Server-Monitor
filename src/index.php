<?php
	session_start();
	
	if (empty($_SESSION['lastSubTime']))
		$_SESSION['lastSubTime'] = time();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5" />
		<link rel="stylesheet" href="css/mdui.min.css" />
		<script type="text/javascript" src="https://cdn.bootcss.com/vConsole/3.3.0/vconsole.min.js"></script>
		<script src="js/mdui.min.js"></script>
		<script>
			function setCookie(name, value) {
				var Days = 30;
				var exp = new Date();
				exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
				document.cookie = name + "=" + escape (value) + ";expires=" + exp.toGMTString() + ";path=/";
			}

			function getCookie(name) {
				var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
				if (arr=document.cookie.match(reg)) {
					return unescape(arr[2]);
				} else {
					return null;
				}
			}
		</script>
		<title>服务器状态</title>
	</head>
	<body class="mdui-appbar-with-toolbar mdui-theme-primary-teal mdui-theme-accent-pink mdui-theme-layout-auto">
		<script>
			if (getCookie('darkmode') == 'true') {
				mdui.$('body').removeClass('mdui-theme-layout-auto');
				mdui.$('body').addClass('mdui-theme-layout-dark');
				
			} else if (getCookie('darkmode')) {
				mdui.$('body').removeClass('mdui-theme-layout-auto');
				
			}
		</script>
		
		<header class="mdui-appbar mdui-appbar-fixed">
			<div class="mdui-toolbar mdui-color-theme">
				<a href="#" class="mdui-typo-headline">服务器状态</a>
				<div class="mdui-toolbar-spacer"></div>
				<button onclick="toggleDarkmode(this)" class="mdui-btn mdui-ripple mdui-btn-icon" id="darkmodeBtn"><i class="mdui-icon material-icons">&#xe1ab;</i></button>
				<a href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-menu="{target:'#main_menu'}"><i class="mdui-icon material-icons">more_vert</i></a>
				
				<ul class="mdui-menu" id="main_menu">
					<li class="mdui-menu-item">
						<a href="javascript:;" onclick="setRefreshBetween()" class="mdui-ripple">
							<i class="mdui-menu-item-icon mdui-icon material-icons">&#xe01b;</i>设置刷新频率
						</a>
					</li>
					<li class="mdui-menu-item">
						<a href="javascript:;" onclick="toggleRefresh(this)" class="mdui-ripple">
							<i class="mdui-menu-item-icon mdui-icon material-icons">&#xe034;</i>暂停自动刷新
						</a>
					</li>
					<li class="mdui-menu-item">
						<a href="javascript:;" onclick="getServerInfo()" class="mdui-ripple">
							<i class="mdui-menu-item-icon mdui-icon material-icons">&#xe5d5;</i>立即刷新
						</a>
					</li>
					<li class="mdui-divider"></li>
					<li class="mdui-menu-item" onclick="enableConsole(this)">
						<a href="javascript:;" class="mdui-ripple">
							<i class="mdui-menu-item-icon mdui-icon material-icons">&#xe1b0;</i>启用 vConsole
						</a>
					</li>
				</ul>
			</div>
		</header>
		
		<script>
			if (getCookie('darkmode') == 'true') {
				mdui.$('#darkmodeBtn').html('<i class="mdui-icon material-icons">&#xe3a9;</i>');
				
			} else if(getCookie('darkmode')) {
				mdui.$('#darkmodeBtn').html('<i class="mdui-icon material-icons">&#xe3ac;</i>');
				
			}
		</script>
		
		<main class="mdui-container">
			<center><h2>服务器状态</h2></center>
			
			<div class="mdui-row" id="resultDiv">
				<center>
					<div class="mdui-spinner"></div>
				</center>
			</div>
		</main>
		
		<style>
			.mdui-card .mdui-card-content p {
				margin-bottom:0;
			}
		</style>
		
		<script src="js/main.js?202105142342"></script>
	</body>
</html>