<?php /* Smarty version Smarty-3.1.16, created on 2014-12-07 19:09:35
         compiled from "../../app/www/views/restaurant/new_order_reject.html" */ ?>
<?php /*%%SmartyHeaderCode:8661402535484a5ef439821-97332477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'feb4f3497888f40d848d2e3bf3df1676fa4301b3' => 
    array (
      0 => '../../app/www/views/restaurant/new_order_reject.html',
      1 => 1417974286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8661402535484a5ef439821-97332477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5484a5ef4aef05_22207728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5484a5ef4aef05_22207728')) {function content_5484a5ef4aef05_22207728($_smarty_tpl) {?><!DOCTYPE html>
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
			<a href="#offCanvas" class="mui-icon mui-icon-bars mui-pull-left"></a>
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
			<h1>拒绝订单成功</h1>
		</div>
	</body>
</html>
<?php }} ?>
