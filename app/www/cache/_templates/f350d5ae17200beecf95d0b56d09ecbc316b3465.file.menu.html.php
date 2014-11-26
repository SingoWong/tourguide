<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 06:55:09
         compiled from "../../app/www/views/guide/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:114023732554702a196710a4-22274030%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f350d5ae17200beecf95d0b56d09ecbc316b3465' => 
    array (
      0 => '../../app/www/views/guide/menu.html',
      1 => 1416639290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114023732554702a196710a4-22274030',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702a196dd680_03776941',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54702a196dd680_03776941')) {function content_54702a196dd680_03776941($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.menu-list {
				padding: 10px;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-bars mui-pull-left" href="/" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<h1 class="mui-title">请选择项目</h1>
		</header>
		<div class="mui-content">
			<div class="menu-list">
				<button class="mui-btn mui-btn-block" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
';">团号资讯</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
';">订餐系统</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
';">订房系统</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
';">意外通报</button>
			</div>
		</div>
	</body>
</html>
<?php }} ?>
