<?php /* Smarty version Smarty-3.1.16, created on 2014-12-05 20:32:03
         compiled from "../../app/www/views/sysmanager/agency_profile_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:6157840925481fb44f13352-66606924%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85a6e29213b70dd3585c81ae4c61b9c78dcf3441' => 
    array (
      0 => '../../app/www/views/sysmanager/agency_profile_edit.html',
      1 => 1417806189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6157840925481fb44f13352-66606924',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5481fb450e41e0_12125924',
  'variables' => 
  array (
    'type' => 0,
    'profile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5481fb450e41e0_12125924')) {function content_5481fb450e41e0_12125924($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	旅行社管理 - 修改資料
</div>

<div class="form_inner">

<form action="index.php?ctr=sysagency&act=saveprofile" method="post" class="gm_t1_form">
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
