<?php /* Smarty version Smarty-3.1.16, created on 2014-12-14 18:31:34
         compiled from "../../app/www/views/guide/restaurant_search.html" */ ?>
<?php /*%%SmartyHeaderCode:132375434547a133ce2e310-81866480%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c1d2bb3f355c20f3e40233ae3e4144d71fc293b' => 
    array (
      0 => '../../app/www/views/guide/restaurant_search.html',
      1 => 1418581893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132375434547a133ce2e310-81866480',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547a133ce8f3a7_50607198',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_restaurant_result' => 0,
    'gid' => 0,
    'day' => 0,
    'route' => 0,
    'type' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547a133ce8f3a7_50607198')) {function content_547a133ce8f3a7_50607198($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>餐廳搜索</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-search {
				padding: 10px;
			}
			.info-search h3 {
				background: #CCC!important;
				padding: 10px!important;
				border-radius: 5px!important;
				text-align: center;
				font-size: 16px;
			}
			.mui-input-row {
				height: 50px!important;
				margin-bottom: 10px!important;
			}
			.mui-input-row input.mui-input-clear {
				background: #FFF;
				border-radius: 5px;
				height: 50px;
				line-height: 50px;
			}
			.mui-icon-clear {
				top: 15px!important;
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
			<div class="info-search">
				<h3>搜索餐廳</h3>
				<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_result']->value;?>
" method="post">
					<div class="mui-input-row">
						<input type="text" class="mui-input-clear" name="city" placeholder="城市">
					</div>
					<div class="mui-input-row">
						<input type="text" class="mui-input-clear" name="name" placeholder="名稱">
					</div>
					<!--<div class="mui-input-row">
						<input type="text" class="mui-input-clear" name="scenic" placeholder="附近景點">
					</div>-->
					
					<div class="signin_submit">
						<input type="hidden" name="gid" value="<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
" />
						<input type="hidden" name="day" value="<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
" />
						<input type="hidden" name="route" value="<?php echo $_smarty_tpl->tpl_vars['route']->value;?>
" />
						<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" />
						<button class="mui-btn mui-btn-primary mui-btn-block">搜尋</button>
					</div>
				</form>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">
		    訂餐資訊
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
