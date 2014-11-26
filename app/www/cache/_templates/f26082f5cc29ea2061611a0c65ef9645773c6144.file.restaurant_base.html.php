<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 06:55:08
         compiled from "../../app/www/views/guide/restaurant_base.html" */ ?>
<?php /*%%SmartyHeaderCode:104942899354702d47168a23-76198650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f26082f5cc29ea2061611a0c65ef9645773c6144' => 
    array (
      0 => '../../app/www/views/guide/restaurant_base.html',
      1 => 1416639287,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104942899354702d47168a23-76198650',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702d471b0f98_95589839',
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
<?php if ($_valid && !is_callable('content_54702d471b0f98_95589839')) {function content_54702d471b0f98_95589839($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>订餐资讯</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-journey {
				padding: 10px;
			}
			.info-flow {
				
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
">团号</a>
					<a class="mui-control-item mui-active" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">订餐</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
">订房</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-journey">
				<div class="info-flow">-</div>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="#">
		    订餐资讯
		  </a>
		  <a class="mui-tab-item" href="#">
		    餐厅搜索
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
