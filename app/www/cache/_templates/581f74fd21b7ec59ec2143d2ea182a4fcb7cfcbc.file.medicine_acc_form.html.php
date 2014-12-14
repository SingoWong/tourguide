<?php /* Smarty version Smarty-3.1.16, created on 2014-12-03 17:52:04
         compiled from "../../app/www/views/accident/medicine_acc_form.html" */ ?>
<?php /*%%SmartyHeaderCode:1853069428547f4dc466b1e1-34339711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '581f74fd21b7ec59ec2143d2ea182a4fcb7cfcbc' => 
    array (
      0 => '../../app/www/views/accident/medicine_acc_form.html',
      1 => 1417629065,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1853069428547f4dc466b1e1-34339711',
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
    'url_bus_submit' => 0,
    'time' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f4dc46e2da5_15923713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f4dc46e2da5_15923713')) {function content_547f4dc46e2da5_15923713($_smarty_tpl) {?><!DOCTYPE html>
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
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_bus_submit']->value;?>
" method="post" id="form">
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="time" placeholder="發生時間" value="<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
">
				</div>
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="location" placeholder="發生地點">
				</div>
				<div class="mui-input-row">
					<label>事故狀況：</label>
				</div>
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="amount" placeholder="旅客人數">
				</div>
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="detail" placeholder="備註">
				</div>
				<div class="mui-input-row">
					<!-- 圖片 -->
				</div>
				
				<div class="signin_submit">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
					<button class="mui-btn mui-btn-primary mui-btn-block">回報上傳</button>
				</div>
			</form>
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
