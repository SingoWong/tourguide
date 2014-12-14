<?php /* Smarty version Smarty-3.1.16, created on 2014-12-07 08:08:36
         compiled from "../../app/www/views/guide/restaurant_order.html" */ ?>
<?php /*%%SmartyHeaderCode:151325825454840b048db0f4-89554697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '790d9ba527fc8433c23bf39324ee4cb652e4e24e' => 
    array (
      0 => '../../app/www/views/guide/restaurant_order.html',
      1 => 1417616513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151325825454840b048db0f4-89554697',
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
  'unifunc' => 'content_54840b049cb274_43668337',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54840b049cb274_43668337')) {function content_54840b049cb274_43668337($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>餐廳下單成功</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-detail {
				padding: 10px;
			}
			.restaurant-detail {
				
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
			<div class="info-detail">
				<h1>訂餐信息已送出</h1>
				<h1>請等待餐廳回復</h1>
				<div>觸碰螢幕回到訂餐系統主畫面</div>
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
