<?php /* Smarty version Smarty-3.1.16, created on 2014-12-20 01:26:20
         compiled from "../../app/www/views/accident/desert_form.html" */ ?>
<?php /*%%SmartyHeaderCode:1109494126547f4f4d6b7787-57851203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '645a874cde87cbbe9f1cd0a390f065c01f7216f8' => 
    array (
      0 => '../../app/www/views/accident/desert_form.html',
      1 => 1417632186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1109494126547f4f4d6b7787-57851203',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f4f4d73e188_95714569',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_desert_submit' => 0,
    'time' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f4f4d73e188_95714569')) {function content_547f4f4d73e188_95714569($_smarty_tpl) {?><!DOCTYPE html>
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
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_desert_submit']->value;?>
" method="post" id="form">
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="time" placeholder="發生時間" value="<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
">
				</div>
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="location" placeholder="發生地點">
				</div>
				<div id="pnl_names">
				<div class="mui-input-row">
					<input type="text" class="mui-input-clear" name="name[]" placeholder="姓名">
				</div>
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
