<?php /* Smarty version Smarty-3.1.16, created on 2014-12-09 14:19:09
         compiled from "../../app/www/views/hotel/new_order_confirm.html" */ ?>
<?php /*%%SmartyHeaderCode:48302669548704ddad3cc1-83680597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e969413eea6c8738b0d1774c1e4607e5c816b3a3' => 
    array (
      0 => '../../app/www/views/hotel/new_order_confirm.html',
      1 => 1418134442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48302669548704ddad3cc1-83680597',
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
  'unifunc' => 'content_548704ddb464f2_95516340',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548704ddb464f2_95516340')) {function content_548704ddb464f2_95516340($_smarty_tpl) {?><!DOCTYPE html>
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
			<a href="#" class="mui-icon mui-icon-bars mui-pull-left" onclick="history.go(-1);return false;"></a>
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
