<?php /* Smarty version Smarty-3.1.16, created on 2014-12-11 17:17:11
         compiled from "../../app/www/views/mobile/login.html" */ ?>
<?php /*%%SmartyHeaderCode:186414532547c59a75a0844-56311164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edd9c5327223f4aaf83a1b311e98bf7a75d2c219' => 
    array (
      0 => '../../app/www/views/mobile/login.html',
      1 => 1418318222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186414532547c59a75a0844-56311164',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547c59a761bf13_01016641',
  'variables' => 
  array (
    'title' => 0,
    'url_do_login' => 0,
    'url_forgot_guide' => 0,
    'url_services' => 0,
    'url_policy' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547c59a761bf13_01016641')) {function content_547c59a761bf13_01016641($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.logo {
				background: url(./theme/images/slogo.png) center 10px no-repeat;
				background-size: 210px;
				height: 210px;
				width: 210px;
				margin: auto;
			}
			.mui-input-row {
				padding: 5px 10px!important;
				background-image: none!important;
				height: auto!important;
			}
			.mui-input-clear {
				border-radius: 5px!important;
				height: 50px!important;
				line-height: 50px!important;
				background: #FFF!important;
			}
			.mui-icon-clear {
				right: 10px!important;
				top: 20px!important;
			}
			.signin_submit {
				padding: 10px;
				overflow: hidden;
			}
			.signin_submit .btn-signin {
				margin-right: 60px;
				height: 50px;
			}
			.signin_submit .btn-forgot {
				float: right;
				width: 55px;
				height: 58px;
				line-height: 20px!important;
				padding-top: 8px;
			}
			.agreement {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" onclick="history.go(-1);"></a>
			<h1 class="mui-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
		</header>
		<div class="mui-content">
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_do_login']->value;?>
" method="post">
				<div class="logo"></div>
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="username" placeholder="帳號">
				</div>
				<div class="mui-input-row">
					<input type="password" class="mui-input-clear" name="password" placeholder="密碼">
				</div>
				
				<div class="signin_submit">
					<a class="mui-btn mui-btn-block btn-forgot" href="<?php echo $_smarty_tpl->tpl_vars['url_forgot_guide']->value;?>
">忘記<br/>密碼</a>
					<div class="btn-signin"><button class="mui-btn mui-btn-primary mui-btn-block">登入</button></div>
				</div>
				<div class="agreement">
					按下登入，表示統一<a href="<?php echo $_smarty_tpl->tpl_vars['url_services']->value;?>
">服務條款</a>及<a href="<?php echo $_smarty_tpl->tpl_vars['url_policy']->value;?>
">隱私權政策</a>
				</div>
			</form>
		</div>
	</body>
</html>
<?php }} ?>
