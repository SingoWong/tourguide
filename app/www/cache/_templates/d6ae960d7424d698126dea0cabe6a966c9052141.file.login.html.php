<?php /* Smarty version Smarty-3.1.16, created on 2014-12-02 15:54:54
         compiled from "../../app/www/views/sysmanager/login.html" */ ?>
<?php /*%%SmartyHeaderCode:2061755612547c2d4146a452-74857548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6ae960d7424d698126dea0cabe6a966c9052141' => 
    array (
      0 => '../../app/www/views/sysmanager/login.html',
      1 => 1417532637,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2061755612547c2d4146a452-74857548',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547c2d414c45a5_13857340',
  'variables' => 
  array (
    'url_do_login' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547c2d414c45a5_13857340')) {function content_547c2d414c45a5_13857340($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="./libs/jquery/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="./libs/style_t1/t1.css" />
<link rel="stylesheet" type="text/css" href="./theme/style/global.css" />
<link rel="stylesheet" type="text/css" href="./theme/style/users.css" />
<title>CoreSystem</title>
</head>
<body>

<div class="signin_form">
	<div class="logo"></div>
	<form class="gm_t1_form" id="login" action="<?php echo $_smarty_tpl->tpl_vars['url_do_login']->value;?>
" method="POST">
    <ul>
        <li>
            <span class="v"><input type="text" id="username" name="username" placeholder="輸入帳號"></span>
        </li>
        <li>
            <span class="v"><input type="password" id="password" name="password" placeholder="輸入密碼"></span>
        </li>
        <li>
            <input type="submit" class="gm_t1_btn" value="登入">
        </li>
    </ul>
	</form>
</div>

</body>
</html><?php }} ?>
