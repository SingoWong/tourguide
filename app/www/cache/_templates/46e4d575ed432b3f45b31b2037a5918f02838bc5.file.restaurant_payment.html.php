<?php /* Smarty version Smarty-3.1.16, created on 2014-12-03 14:23:19
         compiled from "../../app/www/views/guide/restaurant_payment.html" */ ?>
<?php /*%%SmartyHeaderCode:1190256346547bc51e6b3547-65797069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46e4d575ed432b3f45b31b2037a5918f02838bc5' => 
    array (
      0 => '../../app/www/views/guide/restaurant_payment.html',
      1 => 1417616531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1190256346547bc51e6b3547-65797069',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547bc51e718c95_91649173',
  'variables' => 
  array (
    'url_restaurant' => 0,
    'url_info' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_restaurant_payment_checklist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547bc51e718c95_91649173')) {function content_547bc51e718c95_91649173($_smarty_tpl) {?><!DOCTYPE html>
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
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
'">團號</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
'">訂餐</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="menu-list">
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant_payment_checklist']->value;?>
&mode=0';">現金</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant_payment_checklist']->value;?>
&mode=1';">刷卡</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant_payment_checklist']->value;?>
&mode=2';">簽單</button>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="#">
		    訂餐資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
