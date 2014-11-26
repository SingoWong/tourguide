<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 07:12:53
         compiled from "../../app/www/views/guide/info_journey.html" */ ?>
<?php /*%%SmartyHeaderCode:3460976615470312a6341e8-30470229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9028acb1357f11da1ac12053e134c7df5e86bdf' => 
    array (
      0 => '../../app/www/views/guide/info_journey.html',
      1 => 1416639453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3460976615470312a6341e8-30470229',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470312a69b780_53047358',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_info_journey' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470312a69b780_53047358')) {function content_5470312a69b780_53047358($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>行程资讯</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-journey {
				
			}
			.info-map {
				height: 200px;
			}
			.info-flow {
				
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-bars mui-pull-left" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item mui-active" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
">团号</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">订餐</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
">订房</a>
					<a class="mui-control-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-journey">
				<div class="info-map"></div>
				<div class="info-flow"></div>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
">
		    团号资讯
		  </a>
		  <a class="mui-tab-item mui-active" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info_journey']->value;?>
">
		    行程资讯
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
