<?php /* Smarty version Smarty-3.1.16, created on 2014-12-06 06:22:37
         compiled from "../../app/www/views/sysmanager/hotel_profile_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:10447351445482a0ad7b3af6-03869762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84f12cc3b23dcc48c947c9a6fb55b2bbb9e9fb17' => 
    array (
      0 => '../../app/www/views/sysmanager/hotel_profile_edit.html',
      1 => 1417811705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10447351445482a0ad7b3af6-03869762',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type' => 0,
    'profile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5482a0ad86f8f9_85352800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5482a0ad86f8f9_85352800')) {function content_5482a0ad86f8f9_85352800($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	飯店管理 - 修改資料
</div>

<div class="form_inner">

<form action="index.php?ctr=syshotel&act=saveprofile" method="post" class="gm_t1_form">
    <ul>
        <li>
        	<?php if ($_smarty_tpl->tpl_vars['type']->value=='address') {?>
            <span class="v"><input type="text" id="address" name="address" placeholder="地址" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->address;?>
"></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['type']->value=='contact') {?>
            <span class="v"><input type="text" id="contact" name="contact" placeholder="聯繫人" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->contact;?>
"></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['type']->value=='contact_tel') {?>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="聯繫電話" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->contact_tel;?>
"></span>
            <?php }?>
        </li>
        <li class="gm_t1_form_btn" style="height:auto;">
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value->uid;?>
" />
        	<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" />
            <input type="submit" class="gm_t1_btn" value="提交">
        </li>
    </ul>
</form>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/popup_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
