<?php /* Smarty version Smarty-3.1.16, created on 2014-12-11 14:48:16
         compiled from "../../app/www/views/restaurant/report_search.html" */ ?>
<?php /*%%SmartyHeaderCode:10529782225489aeb0c85331-68711375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '607461f0dca5d213aa959b9c7c5608922b438531' => 
    array (
      0 => '../../app/www/views/restaurant/report_search.html',
      1 => 1418134392,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10529782225489aeb0c85331-68711375',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5489aeb0cf2f91_86506615',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5489aeb0cf2f91_86506615')) {function content_5489aeb0cf2f91_86506615($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>餐厅搜索</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-search {
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
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_new_order']->value;?>
';">新进</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_report']->value;?>
';">报表</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-search">
				<h3>报表查询</h3>
				<form class="mui-input-group">
					<div class="mui-input-row">
						<input type="text" class="mui-input-clear" placeholder="旅行社">
					</div>
					<div class="mui-input-row">
						<input type="text" class="mui-input-clear" placeholder="导游">
					</div>
					<div class="mui-input-row">
						<input type="text" class="mui-input-clear" placeholder="日期">
					</div>
					
					<div class="signin_submit">
						<button class="mui-btn mui-btn-primary mui-btn-block btn-signin">登陆</button>
					</div>
				</form>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="#">
		    订餐资讯
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    餐厅搜索
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
