<?php /* Smarty version Smarty-3.1.16, created on 2014-12-01 03:36:14
         compiled from "../../app/www/views/guide/restaurant_payment_confirm.html" */ ?>
<?php /*%%SmartyHeaderCode:577416464547be0c6e9ad23-43413765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd75d0e07cd3b4eb8638994f77b0a836aa294b53a' => 
    array (
      0 => '../../app/www/views/guide/restaurant_payment_confirm.html',
      1 => 1417404948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '577416464547be0c6e9ad23-43413765',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547be0c6e9b9b6_95272557',
  'variables' => 
  array (
    'url_restaurant' => 0,
    'url_info' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547be0c6e9b9b6_95272557')) {function content_547be0c6e9b9b6_95272557($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<script type="text/javascript">
		
		</script>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" href="<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
">团号</a>
					<a class="mui-control-item mui-active" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">订餐</a>
					<a class="mui-control-item" href="<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
">订房</a>
					<a class="mui-control-item" href="<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="confirm-form">
				<div class="confirm_content">
					<img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" width="300" />
				</div>
				<div style="text-align: center;">
					<button class="mui-btn mui-btn-primary">重拍</button>
					<button class="mui-btn mui-btn-primary">上传云端</button>
				</div>
				<br/><br/>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="#">
		    订餐资讯
		  </a>
		  <a class="mui-tab-item" href="#">
		    餐厅搜索
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
