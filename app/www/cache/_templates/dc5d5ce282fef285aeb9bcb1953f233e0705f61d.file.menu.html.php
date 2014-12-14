<?php /* Smarty version Smarty-3.1.16, created on 2014-12-07 06:55:49
         compiled from "../../app/www/views/accident/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:871587542547f1dc4663009-26158484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc5d5ce282fef285aeb9bcb1953f233e0705f61d' => 
    array (
      0 => '../../app/www/views/accident/menu.html',
      1 => 1417659266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '871587542547f1dc4663009-26158484',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f1dc46a1452_24591127',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_bus_photo_choose' => 0,
    'url_medicine_photo_choose' => 0,
    'url_desert_form' => 0,
    'url_natural_photo_choose' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f1dc46a1452_24591127')) {function content_547f1dc46a1452_24591127($_smarty_tpl) {?><!DOCTYPE html>
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
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
'">團號</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
'">訂餐</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="menu-list">
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_bus_photo_choose']->value;?>
'">遊覽車事故</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_medicine_photo_choose']->value;?>
'">團員發生傷病</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_desert_form']->value;?>
'">團員脫團</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_natural_photo_choose']->value;?>
'">天災行程滯留</button>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="tel://119">
		    救護車119
		  </a>
		  <a class="mui-tab-item mui-active" href="tel://110">
		    報警110
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    聯繫旅行社
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
