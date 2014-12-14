<?php /* Smarty version Smarty-3.1.16, created on 2014-12-09 14:20:10
         compiled from "../../app/www/views/hotel/new_order_reson.html" */ ?>
<?php /*%%SmartyHeaderCode:18999383085487051a194fc2-64606749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e7859c6edc8af85569c7c618f92ddafb5d0bad5' => 
    array (
      0 => '../../app/www/views/hotel/new_order_reson.html',
      1 => 1418134432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18999383085487051a194fc2-64606749',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
    'url_reject_submit' => 0,
    'oid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5487051a23cf72_61947081',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5487051a23cf72_61947081')) {function content_5487051a23cf72_61947081($_smarty_tpl) {?><!DOCTYPE html>
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
			<a href="#" class="mui-icon mui-icon-bars mui-pull-left" onclick="history.go(-1);return false;"></a>
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
							<label>拒絕理由1</label>
							<input name="reson[]" type="checkbox" value="拒絕理由1">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由2</label>
							<input name="reson[]" type="checkbox" value="拒絕理由2">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由3</label>
							<input name="reson[]" type="checkbox" value="拒絕理由3">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由4</label>
							<input name="reson[]" type="checkbox" value="拒絕理由4">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由5</label>
							<input name="reson[]" type="checkbox" value="拒絕理由5">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由6</label>
							<input name="reson[]" type="checkbox" value="拒絕理由6">
						</div>
						<div class="mui-input-row mui-checkbox mui-left">
							<label>拒絕理由7</label>
							<input name="reson[]" type="checkbox" value="拒絕理由7">
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
