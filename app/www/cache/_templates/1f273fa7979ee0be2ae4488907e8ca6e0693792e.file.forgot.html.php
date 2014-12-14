<?php /* Smarty version Smarty-3.1.16, created on 2014-12-11 14:44:59
         compiled from "../../app/www/views/guide/forgot.html" */ ?>
<?php /*%%SmartyHeaderCode:1936727610547c5ab0a2cda9-17527502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f273fa7979ee0be2ae4488907e8ca6e0693792e' => 
    array (
      0 => '../../app/www/views/guide/forgot.html',
      1 => 1418309071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1936727610547c5ab0a2cda9-17527502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547c5ab0a737f6_49062072',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547c5ab0a737f6_49062072')) {function content_547c5ab0a737f6_49062072($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" onclick="history.go(-1);"></a>
			<h1 class="mui-title">忘記密碼</h1>
		</header>
		<div class="mui-content result-page">
			<div class="icon_success"></div>
			<div class="result-tips">請聯絡你所對應旅行社</div>
			<button class="mui-btn mui-btn-primary mui-btn-block">撥給旅行社</button>
		</div>
	</body>
</html>
<?php }} ?>
