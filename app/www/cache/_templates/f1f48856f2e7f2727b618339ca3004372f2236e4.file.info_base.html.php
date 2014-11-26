<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 07:02:08
         compiled from "../../app/www/views/guide/info_base.html" */ ?>
<?php /*%%SmartyHeaderCode:16024723154702cde8acc76-88205240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1f48856f2e7f2727b618339ca3004372f2236e4' => 
    array (
      0 => '../../app/www/views/guide/info_base.html',
      1 => 1416639445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16024723154702cde8acc76-88205240',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702cde918189_77071163',
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
<?php if ($_valid && !is_callable('content_54702cde918189_77071163')) {function content_54702cde918189_77071163($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>团号资讯</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-content {
				padding: 10px;
			}
			.info-content-item {
				padding: 20px;
				background: #FFF;
				border: 1px solid #999;
				margin-bottom: 3px;
			}
			.info-content-tips {
				color: #666;
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
			<div class="info-content">
				<div class="info-content-item">A3984792394</div>
				<div class="info-content-item">台北六日游</div>
				<div class="info-content-tips">相关团行：无</div>
				
				<ul class="mui-table-view mui-table-view-chevron">
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">旅行社资讯</a>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell">
								--1
							</li>
						</ul>
					</li>
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">相关联络人资讯</a>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell">
								--2
							</li>
						</ul>
					</li>
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">航班资讯</a>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell">
								--3
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
">
		    团号资讯
		  </a>
		  <a class="mui-tab-item" href="index.php?<?php echo $_smarty_tpl->tpl_vars['url_info_journey']->value;?>
">
		    行程资讯
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
