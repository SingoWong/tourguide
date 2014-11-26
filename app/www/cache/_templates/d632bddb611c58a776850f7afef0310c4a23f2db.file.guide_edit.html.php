<?php /* Smarty version Smarty-3.1.16, created on 2014-11-23 18:51:40
         compiled from "../../app/www/views/sysmanager/guide_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:13031262505470a479326574-42785343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd632bddb611c58a776850f7afef0310c4a23f2db' => 
    array (
      0 => '../../app/www/views/sysmanager/guide_edit.html',
      1 => 1416768686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13031262505470a479326574-42785343',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a479394d70_67843079',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a479394d70_67843079')) {function content_5470a479394d70_67843079($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	导游管理 - 新增导游
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="续约导游" onclick="self.location.href='index.php?ctr=sysguide';">
<input type="button" class="gm_t1_btn_alt_disabled" value="过期导游" onclick="self.location.href='index.php?ctr=sysguide&act=expired';">
<input type="button" class="gm_t1_btn" value="新增导游" onclick="self.location.href='index.php?ctr=sysguide&act=edit';">

<div class="form_inner">

<form action="index.php?ctr=sysguide&act=save" method="post" class="gm_t1_form">
    <ul>
        <li>
            <span class="v"><input type="text" id="name" name="name" placeholder="导游名称"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="电话"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="" name="" placeholder="流水号"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="code" name="code" placeholder="统一编码"><em></em></span>
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
