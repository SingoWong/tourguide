<?php /* Smarty version Smarty-3.1.16, created on 2014-12-23 01:35:06
         compiled from "../../app/www/views/restaurant/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:68525177054702e34ccccb4-60828853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cc7c281485d2531bb25ad5d453de7424747273f' => 
    array (
      0 => '../../app/www/views/restaurant/menu.html',
      1 => 1419109297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68525177054702e34ccccb4-60828853',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702e34d1b3a3_30171873',
  'variables' => 
  array (
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54702e34d1b3a3_30171873')) {function content_54702e34d1b3a3_30171873($_smarty_tpl) {?><!DOCTYPE html>
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
			<a class="mui-icon mui-icon-bars mui-pull-left" href="/"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<h1 class="mui-title">請選擇項目</h1>
		</header>
		<div class="mui-content">
			<div class="menu-list">
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_today']->value;?>
';">準備訂單</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_new_order']->value;?>
';">新進訂單</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_report']->value;?>
';">報表查詢</button>
			</div>
		</div>
	</body>
</html>
<?php }} ?>
