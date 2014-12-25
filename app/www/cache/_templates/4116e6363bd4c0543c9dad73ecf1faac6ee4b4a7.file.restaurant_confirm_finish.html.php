<?php /* Smarty version Smarty-3.1.16, created on 2014-12-22 00:36:37
         compiled from "../../app/www/views/guide/restaurant_confirm_finish.html" */ ?>
<?php /*%%SmartyHeaderCode:20175959835496f5ee17f181-11524213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4116e6363bd4c0543c9dad73ecf1faac6ee4b4a7' => 
    array (
      0 => '../../app/www/views/guide/restaurant_confirm_finish.html',
      1 => 1419179795,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20175959835496f5ee17f181-11524213',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5496f5ee1e8517_70394045',
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
<?php if ($_valid && !is_callable('content_5496f5ee1e8517_70394045')) {function content_5496f5ee1e8517_70394045($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>餐廳已確認</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
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
		<div class="mui-content result-page">
			<div class="icon_success"></div>
			<div class="result-tips">訂單已確認</div>
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
