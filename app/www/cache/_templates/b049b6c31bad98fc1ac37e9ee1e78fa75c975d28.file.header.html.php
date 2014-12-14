<?php /* Smarty version Smarty-3.1.16, created on 2014-12-02 15:00:47
         compiled from "../../app/www/views/_common/header.html" */ ?>
<?php /*%%SmartyHeaderCode:9831993685470967b9539d0-45970908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b049b6c31bad98fc1ac37e9ee1e78fa75c975d28' => 
    array (
      0 => '../../app/www/views/_common/header.html',
      1 => 1417532399,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9831993685470967b9539d0-45970908',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470967b95c7e2_61825543',
  'variables' => 
  array (
    'RBAC_USER_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470967b95c7e2_61825543')) {function content_5470967b95c7e2_61825543($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="/libs/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/libs/jquery/core.popup.js"></script>
<link rel="stylesheet" type="text/css" href="/libs/style_t1/t1.css" />
<link rel="stylesheet" type="text/css" href="/theme/style/global.css" />
<link rel="stylesheet" type="text/css" href="/theme/style/sysmanager.css" />
<title>CoreSystem</title>
</head>
<body>
<div class="viewport">
	
	<div class="view-header">
		<div class="header-inner">
			<div class="rctl">
				<a href="/index.php?ctr=users&act=secret" onclick="return window.openWindow(self.href,'400','300',false,0.3)" class="btn_setup"><?php echo $_smarty_tpl->tpl_vars['RBAC_USER_NAME']->value;?>
</a>
				<span>|</span>
				<a href="/index.php?ctr=sysusers&act=logout">登出</a>
			</div>
			<div class="logo">CoreSystem</div>
		</div>
	</div>
	
	<div class="view-content wrap">
		<div class="menu-inner">
			<?php echo $_smarty_tpl->getSubTemplate ("_common/navigation.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
		<div class="content-inner"><?php }} ?>
