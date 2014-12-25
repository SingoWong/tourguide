<?php /* Smarty version Smarty-3.1.16, created on 2014-12-20 01:17:40
         compiled from "../../app/www/views/accident/bus_acc_finish.html" */ ?>
<?php /*%%SmartyHeaderCode:1985310484547f47217a90d6-72928507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ab07d610386715b3a3e493bc699b0c1f240f971' => 
    array (
      0 => '../../app/www/views/accident/bus_acc_finish.html',
      1 => 1419009458,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1985310484547f47217a90d6-72928507',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f4721805ed9_86288404',
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
<?php if ($_valid && !is_callable('content_547f4721805ed9_86288404')) {function content_547f4721805ed9_86288404($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
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
		<div class="mui-content result-page">
			<div class="icon_success"></div>
			<div class="result-tips">回報完成</div>
			<div class="result-tips">觸碰螢幕回到系統主畫面</div>
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
