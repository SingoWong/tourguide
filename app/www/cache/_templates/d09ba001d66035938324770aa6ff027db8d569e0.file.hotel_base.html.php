<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 06:55:11
         compiled from "../../app/www/views/guide/hotel_base.html" */ ?>
<?php /*%%SmartyHeaderCode:32300137654703124e03bf8-17046285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd09ba001d66035938324770aa6ff027db8d569e0' => 
    array (
      0 => '../../app/www/views/guide/hotel_base.html',
      1 => 1416639302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32300137654703124e03bf8-17046285',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54703124e6ea81_67038324',
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
<?php if ($_valid && !is_callable('content_54703124e6ea81_67038324')) {function content_54703124e6ea81_67038324($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>订房资讯</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-hotel {
				padding: 10px;
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
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">订餐</a>
					<a class="mui-control-item mui-active" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
">订房</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-hotel">
				<div class="info-flow">-</div>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="#">
		    订房资讯
		  </a>
		  <a class="mui-tab-item" href="#">
		    &nbsp
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
