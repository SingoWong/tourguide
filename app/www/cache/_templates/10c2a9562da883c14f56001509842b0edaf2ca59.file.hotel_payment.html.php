<?php /* Smarty version Smarty-3.1.16, created on 2014-12-10 16:50:54
         compiled from "../../app/www/views/guide/hotel_payment.html" */ ?>
<?php /*%%SmartyHeaderCode:814079760547c11bb026b09-35274394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10c2a9562da883c14f56001509842b0edaf2ca59' => 
    array (
      0 => '../../app/www/views/guide/hotel_payment.html',
      1 => 1417616461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '814079760547c11bb026b09-35274394',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547c11bb09b538_28870601',
  'variables' => 
  array (
    'url_restaurant' => 0,
    'url_info' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_hotel_payment_checklist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547c11bb09b538_28870601')) {function content_547c11bb09b538_28870601($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
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
			<div class="menu-list">
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment_checklist']->value;?>
&mode=0';">現金</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment_checklist']->value;?>
&mode=1';">刷卡</button>
				<button class="mui-btn mui-btn-block" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment_checklist']->value;?>
&mode=2';">簽單</button>
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
