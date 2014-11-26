<?php /* Smarty version Smarty-3.1.16, created on 2014-11-23 18:13:24
         compiled from "../../app/www/views/sysmanager/restaurant_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:4265926925470a35a4c6035-44905062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc418610a2533bd0d331c59fa281e55af199583' => 
    array (
      0 => '../../app/www/views/sysmanager/restaurant_edit.html',
      1 => 1416766399,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4265926925470a35a4c6035-44905062',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a35a531bf4_40097744',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a35a531bf4_40097744')) {function content_5470a35a531bf4_40097744($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	餐厅管理 - 新增餐厅
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="续约餐厅" onclick="self.location.href='index.php?ctr=sysrestaurant';">
<input type="button" class="gm_t1_btn_alt_disabled" value="过期餐厅" onclick="self.location.href='index.php?ctr=sysrestaurant&act=expired';">
<input type="button" class="gm_t1_btn" value="新增餐厅" onclick="self.location.href='index.php?ctr=sysrestaurant&act=edit';">

<div class="form_inner">

<form action="index.php?ctr=sysrestaurant&act=save" method="post" class="gm_t1_form">
    <ul>
        <li>
            <span class="v"><input type="text" id="name" name="name" placeholder="餐厅名称"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="address" name="address" placeholder="地址"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="" name="" placeholder="流水号"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="code" name="code" placeholder="统一编码"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="contact" name="contact" placeholder="联络人"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="电话"><em></em></span>
        </li>
        <li>
            <span class="v">
            	<input type="text" id="sign_date_start" name="sign_date_start" placeholder="选择签约开始日期">
            </span>
        </li>
        <li>
            <span class="v">
            	<input type="text" id="sign_date_end" name="sign_date_end" placeholder="选择签约结束日期">
            </span>
        </li>
        <li class="gm_t1_form_btn" style="height:auto;">
            <input type="submit" class="gm_t1_btn" value="提交">
        </li>
    </ul>
</form>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
