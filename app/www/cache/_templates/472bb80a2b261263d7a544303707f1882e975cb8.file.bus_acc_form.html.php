<?php /* Smarty version Smarty-3.1.16, created on 2014-12-14 18:25:26
         compiled from "../../app/www/views/accident/bus_acc_form.html" */ ?>
<?php /*%%SmartyHeaderCode:1277426729547f41d2b1e7b8-00846775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '472bb80a2b261263d7a544303707f1882e975cb8' => 
    array (
      0 => '../../app/www/views/accident/bus_acc_form.html',
      1 => 1418581524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1277426729547f41d2b1e7b8-00846775',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f41d2b7ea73_15933513',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f41d2b7ea73_15933513')) {function content_547f41d2b7ea73_15933513($_smarty_tpl) {?><!DOCTYPE html>
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
			.mui-input-row {
				padding: 3px 0!important;
			}
			.mui-input-row select {
				padding-left: 10px!important;
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
					<label><b>事故狀況：</b></label>
				</div>
				<div class="mui-input-row">
					<label>司機狀況：</label>
					<select name="driver_status">
						<option value="">-</option>
						<option value="0">死亡</option>
						<option value="1">重傷</option>
						<option value="2">輕傷</option>
						<option value="3">平安</option>
					</select>
				</div>
				<div class="mui-input-row">
					<label>旅客狀況：</label>
					<select name="member_status">
						<option value="">-</option>
						<option value="0">死亡</option>
						<option value="1">重傷</option>
						<option value="2">輕傷</option>
						<option value="3">平安</option>
					</select>
				</div>
				<div class="mui-input-row">
					<label>遊覽車狀況：</label>
					<select name="bus_status">
						<option value="">-</option>
						<option value="0">可行進</option>
						<option value="1">無法行進</option>
					</select>
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
