<?php /* Smarty version Smarty-3.1.16, created on 2014-12-13 15:37:54
         compiled from "../../app/www/views/mobile/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:14683532915470265243a522-53853036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56ae03b7b9501934eac0bf1a28564aa264bb2cda' => 
    array (
      0 => '../../app/www/views/mobile/menu.html',
      1 => 1418485072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14683532915470265243a522-53853036',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547026524cea75_68700248',
  'variables' => 
  array (
    'url_guide' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547026524cea75_68700248')) {function content_547026524cea75_68700248($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			body {
				background: #315498!important;
				padding:0;
				margin: 0;;
			}
			.mui-bar {
				background-color: #3c60a5!important;
				-webkit-box-shadow:none;
				box-shadow:none;
			}
			.mui-bar .mui-title {
				color: #FFF;
			}
			.menu-list {
				background: #315498!important;
				margin: auto;
				width: 320px;
				position: relative;
				margin-top: 49px;
			}
			.menu-list .menu_item {
				width: 100px;
				height: 100px;
				position: absolute;
			}
			.menu-list .menu_item label {
				color: #FFF;
				font-size: 16px;
				font-weight: bold;
			}
			#btn-guide {
				background: #00c794 url(./theme/images/icon_guide.png) 40px 30px no-repeat;
				background-size: 40px;
				width: 205px;
				left: 5px;
				top: 0;
			}
			#btn-guide label {
				display: block;
				margin: 40px 0 0 100px;
			}
			#btn-restaurant {
				background: #00bcca url(./theme/images/icon_restaurant.png) center 20px no-repeat;
				background-size: 40px;
				left: 215px;
				top: 0;
			}
			#btn-restaurant label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
			#btn-photos {
				background: #534173 url(./theme/images/icon_photos.png) center 20px no-repeat;
				background-size: 40px;
				top: 105px;
				left: 5px;
			}
			#btn-photos label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
			#btn-spots {
				background: #cdcdcd url(./theme/images/icon_spots.png) 40px 30px no-repeat;
				background-size: 40px;
				width: 205px;
				top: 105px;
				left: 110px;
			}
			#btn-spots label {
				display: block;
				margin: 40px 0 0 100px;
			}
			#btn-agency {
				background: #00c0cf url(./theme/images/icon_agency.png) center 20px no-repeat;
				background-size: 40px;
				top: 210px;
				left: 5px;
			}
			#btn-agency label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
			#btn-dutyfree {
				background: #ccc252 url(./theme/images/icon_dutyfree.png) center 20px no-repeat;
				background-size: 40px;
				top: 210px;
				left: 110px;
			}
			#btn-dutyfree label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
			#btn-hotel {
				background: #32579f url(./theme/images/icon_hotel.png) center 60px no-repeat;
				background-size: 40px;
				height: 205px;
				top: 210px;
				left: 215px;
			}
			#btn-hotel label {
				display: block;
				margin: 100px 0 0 0;
				text-align: center;
			}
			#btn-gift {
				background: #9d479c url(./theme/images/icon_gift.png) center 20px no-repeat;
				background-size: 40px;
				top: 315px;
				left: 5px;
			}
			#btn-gift label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
			#btn-cshop {
				background: #e27b5c url(./theme/images/icon_cshop.png) center 20px no-repeat;
				background-size: 40px;
				top: 315px;
				left: 110px;
			}
			#btn-cshop label {
				display: block;
				margin: 60px 0 0 0;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">Menu</h1>
		</header>
		<div class="mui-content menu-list">
			<div class="menu_item" id="btn-guide" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_guide']->value;?>
';"><label>導遊</label></div>
			<div class="menu_item" id="btn-restaurant" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
';"><label>餐廳</label></div>
			<div class="menu_item" id="btn-photos"><label>Photos</label></div>
			<div class="menu_item" id="btn-spots"><label>景點</label></div>
			<div class="menu_item" id="btn-agency"><label>旅行社</label></div>
			<div class="menu_item" id="btn-dutyfree"><label>免稅店</label></div>
			<div class="menu_item" id="btn-hotel" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
';"><label>飯店</label></div>
			<div class="menu_item" id="btn-gift"><label>伴手禮品</label></div>
			<div class="menu_item" id="btn-cshop"><label>車行</label></div>
			
		</div>
		<script type="text/javascript">
			//tap为mui封装的单击事件，可参考手势事件章节
			document.getElementById('btn-guide').addEventListener('tap', function() {
			  //打开关于页面
			  mui.openWindow({
			    url: 'guide/signin.html', 
			    id:'guide'
			  });
			});
		</script>
	</body>
</html>
<?php }} ?>
