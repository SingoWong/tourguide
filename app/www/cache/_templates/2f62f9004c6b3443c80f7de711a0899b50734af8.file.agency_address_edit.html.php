<?php /* Smarty version Smarty-3.1.16, created on 2014-12-05 18:17:07
         compiled from "../../app/www/views/sysmanager/agency_address_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:14663980075481f614d24cc5-58017358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f62f9004c6b3443c80f7de711a0899b50734af8' => 
    array (
      0 => '../../app/www/views/sysmanager/agency_address_edit.html',
      1 => 1417803424,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14663980075481f614d24cc5-58017358',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5481f614de3ec4_91558931',
  'variables' => 
  array (
    'profile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5481f614de3ec4_91558931')) {function content_5481f614de3ec4_91558931($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	旅行社管理 - 修改旅行社地址
</div>

<div class="form_inner">

<form action="index.php?ctr=sysagency&act=saveaddress" method="post" class="gm_t1_form">
    <ul>
        <li>
            <span class="v"><input type="text" id="address" name="address" placeholder="地址" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->address;?>
"></span>
        </li>
        <li class="gm_t1_form_btn" style="height:auto;">
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->uid;?>
" />
            <input type="submit" class="gm_t1_btn" value="提交">
        </li>
    </ul>
</form>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/popup_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
