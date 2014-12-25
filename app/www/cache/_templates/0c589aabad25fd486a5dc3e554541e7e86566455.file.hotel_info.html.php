<?php /* Smarty version Smarty-3.1.16, created on 2014-12-22 03:17:43
         compiled from "../../app/www/views/guide/hotel_info.html" */ ?>
<?php /*%%SmartyHeaderCode:16924141355497199ca85571-94292544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c589aabad25fd486a5dc3e554541e7e86566455' => 
    array (
      0 => '../../app/www/views/guide/hotel_info.html',
      1 => 1419189461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16924141355497199ca85571-94292544',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5497199cae12e5_39176379',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'room' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5497199cae12e5_39176379')) {function content_5497199cae12e5_39176379($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/function.math.php';
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>CheckIn</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-hotel {
				padding: 10px;
			}
			.item-room {
				padding: 10px;
				border-bottom: 1px solid #EAEAEA;
			}
			.item-room em {
				display: inline-block;
				width: 50px;
			}
			.item-room span {
				display: inline-block;
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
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="item-room">
				<em>單人房</em>
				<span><?php echo $_smarty_tpl->tpl_vars['room']->value->single_room;?>
</span>
			</div>
			<div class="item-room">
				<em>雙人房</em>
				<span><?php echo $_smarty_tpl->tpl_vars['room']->value->double_room;?>
</span>
			</div>
			<div class="item-room">
				<em>三人房</em>
				<span><?php echo $_smarty_tpl->tpl_vars['room']->value->full_room;?>
</span>
			</div>
			<div class="item-room">
				<em>加床</em>
				<span><?php echo $_smarty_tpl->tpl_vars['room']->value->plus_room;?>
</span>
			</div>
			<div class="item-room">
				<em>兒童床</em>
				<span><?php echo $_smarty_tpl->tpl_vars['room']->value->kid_room;?>
</span>
			</div>
			<div class="item-room">
				<em>總計</em>
				<span><?php echo smarty_function_math(array('equation'=>"s+(d*2)+(f*3)+p+k",'s'=>$_smarty_tpl->tpl_vars['room']->value->single_room,'d'=>$_smarty_tpl->tpl_vars['room']->value->double_room,'f'=>$_smarty_tpl->tpl_vars['room']->value->full_room,'p'=>$_smarty_tpl->tpl_vars['room']->value->plus_room,'k'=>$_smarty_tpl->tpl_vars['room']->value->kid_room),$_smarty_tpl);?>
</span>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="#">
		    訂房資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    &nbsp
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
