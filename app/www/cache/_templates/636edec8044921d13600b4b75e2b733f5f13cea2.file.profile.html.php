<?php /* Smarty version Smarty-3.1.16, created on 2014-12-02 14:30:23
         compiled from "../../app/www/views/agency/profile.html" */ ?>
<?php /*%%SmartyHeaderCode:171163319254748c0212dc17-65893696%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '636edec8044921d13600b4b75e2b733f5f13cea2' => 
    array (
      0 => '../../app/www/views/agency/profile.html',
      1 => 1417530620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171163319254748c0212dc17-65893696',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54748c02167dd8_78093477',
  'variables' => 
  array (
    'RBAC_USER_NAME' => 0,
    'profile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748c02167dd8_78093477')) {function content_54748c02167dd8_78093477($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<style type="text/css">
ul.profile li {
	height: 30px;
	line-height: 30px;
	padding-left:20px;
	font-size:14px;
}
</style>

<div class="title_panel">
	旅行社基本资料
</div>

<div class="list_inner">

<ul class="profile">
    <li>
        <span class="v">流水號：-</span>
    </li>
    <li>
        <span class="v">旅行社名稱：<em><?php echo $_smarty_tpl->tpl_vars['RBAC_USER_NAME']->value;?>
</em></span>
    </li>
    <li>
        <span class="v">旅行社地址：<em><?php echo $_smarty_tpl->tpl_vars['profile']->value->address;?>
</em></span>
    </li>
    <li>
        <span class="v">聯絡人：<?php echo $_smarty_tpl->tpl_vars['profile']->value->contact;?>
</span>
    </li>
    <li>
        <span class="v">電話（代表號）：<?php echo $_smarty_tpl->tpl_vars['profile']->value->contact_tel;?>
</span>
    </li>
    <li>
        <span class="v">電話（手機號）：-</span>
    </li>
    <li>
        <span class="v">统一编码：<?php echo $_smarty_tpl->tpl_vars['profile']->value->code;?>
</span>
    </li>
    <li>
        <span class="v">簽約日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['profile']->value->sign_date_start,"Y年m月d日");?>
 至 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['profile']->value->sign_date_end,"Y年m月d日");?>
</span>
    </li>
</ul>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
