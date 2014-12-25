<?php /* Smarty version Smarty-3.1.16, created on 2014-12-15 14:51:59
         compiled from "../../app/www/views/mobile/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:14683532915470265243a522-53853036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56ae03b7b9501934eac0bf1a28564aa264bb2cda' => 
    array (
      0 => '../../app/www/views/mobile/menu.html',
      1 => 1418655117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14683532915470265243a522-53853036',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547026524cea75_68700248',
  'variables' => 
  array (
    'url_guide' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547026524cea75_68700248')) {function content_547026524cea75_68700248($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			body {
				background: url(/theme/images/bg.png)!important;
				background-size: 100%!important;
			}
			.mui-content {
				background: none!important;
			}
			.mui-content .logo {
				background: url(/theme/images/ds.png) center no-repeat!important;
				background-size: 220px!important;
				height: 220px;
			}
			.mui-content .menu_items {
				width: 306px;
				height: 206px;
				margin: auto;
				position: relative;
			}
			.mui-content .menu_item {
				width: 100px;
				height: 100px;
				position: absolute;
			}
			.mui-content .menu_item img {
				width: 100px;
				height: 100px;
			}
			#btn-guide {
				top: 0;
				left: 0;
			}
			#btn-restaurant {
				top: 0;
				left: 103px;
			}
			#btn-hotel {
				top: 0;
				left: 206px;
			}
			#btn-spots {
				top: 103px;
				left: 0;
			}
			#btn-gift {
				top: 103px;
				left: 103px;
			}
			#btn-dutyfree {
				top: 103px;
				left: 206px;
			}
			.banner {
				width: 306px;
				margin: auto;
				padding-top: 3px;
			}
		</style>
	</head>
	<body>
		<!--<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">Menu</h1>
		</header>-->
		<div class="mui-content menu-list top-menu-list">
			<div class="logo"></div>
			<div class="menu_items">
				<div class="menu_item" id="btn-guide" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_guide']->value;?>
';"><img src="/theme/images/icon_guide.png" /></div>
				<div class="menu_item" id="btn-restaurant" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
';"><img src="/theme/images/icon_restaurant.png" /></div>
				<div class="menu_item" id="btn-hotel" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
';"><img src="/theme/images/icon_hotel.png" /></div>
				<div class="menu_item" id="btn-spots"><img src="/theme/images/icon_spots.png" /></div>
				<div class="menu_item" id="btn-gift"><img src="/theme/images/icon_gift.png" /></div>
				<div class="menu_item" id="btn-dutyfree"><img src="/theme/images/icon_dutyfree.png" /></div>
			</div>
			<div class="banner"><img src="/theme/images/banner.png" width="306" /></div>
		</div>
	</body>
</html>
<?php }} ?>
