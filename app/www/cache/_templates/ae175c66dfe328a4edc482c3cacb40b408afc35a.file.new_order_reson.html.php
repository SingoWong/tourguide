<?php /* Smarty version Smarty-3.1.16, created on 2014-12-07 19:08:11
         compiled from "../../app/www/views/restaurant/new_order_reson.html" */ ?>
<?php /*%%SmartyHeaderCode:13472930425484a4bdb5c255-43644126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae175c66dfe328a4edc482c3cacb40b408afc35a' => 
    array (
      0 => '../../app/www/views/restaurant/new_order_reson.html',
      1 => 1417979289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13472930425484a4bdb5c255-43644126',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5484a4bdbd34f0_36830876',
  'variables' => 
  array (
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
    'url_reject_submit' => 0,
    'oid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5484a4bdbd34f0_36830876')) {function content_5484a4bdbd34f0_36830876($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.order-reson {
				padding: 10px;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a href="#offCanvas" class="mui-icon mui-icon-bars mui-pull-left"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_today']->value;?>
';">今日</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_new_order']->value;?>
';">新进</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_report']->value;?>
';">报表</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="order-reson">
				<h5 class="mui-content-padded">选择拒绝理由</h5>
				<div class="mui-card">
					<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_reject_submit']->value;?>
" method="post">
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>Checkbox</label>
							<input name="reson[]" type="checkbox">
						</div>
						<input type="hidden" name="oid" value="<?php echo $_smarty_tpl->tpl_vars['oid']->value;?>
" />
						<button class="mui-btn mui-btn-primary mui-btn-block">拒絕</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }} ?>
