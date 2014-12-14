<?php /* Smarty version Smarty-3.1.16, created on 2014-12-03 18:02:06
         compiled from "../../app/www/views/accident/desert_finish.html" */ ?>
<?php /*%%SmartyHeaderCode:385483309547f501e6ad2f0-70323343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb475a00b1b764165757c910fd0929096ae6fece' => 
    array (
      0 => '../../app/www/views/accident/desert_finish.html',
      1 => 1417629722,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '385483309547f501e6ad2f0-70323343',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f501e707521_45940033',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f501e707521_45940033')) {function content_547f501e707521_45940033($_smarty_tpl) {?><!DOCTYPE html>
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
		<div class="mui-content">
			<div class="info-hotel">
				<h1>回報完成</h1>
				<div>觸碰螢幕回到訂餐系統主畫面</div>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="tel://119">
		    救护车119
		  </a>
		  <a class="mui-tab-item mui-active" href="tel://110">
		    报警110
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    联系旅行社
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
