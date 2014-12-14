<?php /* Smarty version Smarty-3.1.16, created on 2014-12-10 12:51:06
         compiled from "../../app/www/views/restaurant/new_order_confirm.html" */ ?>
<?php /*%%SmartyHeaderCode:6178616655484a2ff0f9ce2-05831589%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0756340fe0e5349517a24e4f99d931d6d0f39fc' => 
    array (
      0 => '../../app/www/views/restaurant/new_order_confirm.html',
      1 => 1418135217,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6178616655484a2ff0f9ce2-05831589',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5484a2ff170b40_36775182',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5484a2ff170b40_36775182')) {function content_5484a2ff170b40_36775182($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a href="#" class="mui-icon mui-icon-bars mui-pull-left" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
';"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_today']->value;?>
';">今日</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_new_order']->value;?>
';">新进</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_report']->value;?>
';">报表</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<h1>接受订单成功</h1>
		</div>
	</body>
</html>
<?php }} ?>
