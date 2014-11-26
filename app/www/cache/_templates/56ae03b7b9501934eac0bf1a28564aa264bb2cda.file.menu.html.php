<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 06:24:23
         compiled from "../../app/www/views/mobile/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:14683532915470265243a522-53853036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56ae03b7b9501934eac0bf1a28564aa264bb2cda' => 
    array (
      0 => '../../app/www/views/mobile/menu.html',
      1 => 1416637461,
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
			.menu-list {
				text-align: center;
				padding: 20px;
				background: #FFF;
			}
			.menu-list .menu_item {
				display: inline-block;
				width: 100px;
				height: 100px;
				line-height: 100px;
				background: #CCC;
				margin: 10px 10px 10px 10px;
			}
		</style>
	</head>
	<body>
		<div class="mui-content menu-list">
			<div class="menu_item" id="btn-guide" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_guide']->value;?>
';">导游</div>
			<div class="menu_item" id="btn-restaurant" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
';">餐厅</div>
			<div class="menu_item" id="btn-hotel" onclick="location.href='index.php?<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
';">饭店</div>
			<div class="menu_item">景点</div>
			<div class="menu_item">伴手礼品</div>
			<div class="menu_item">免税店</div>
			<div class="menu_item">车行</div>
			<div class="menu_item">旅行社</div>
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
