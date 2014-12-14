<?php /* Smarty version Smarty-3.1.16, created on 2014-12-05 17:59:53
         compiled from "../../app/www/views/sysmanager/agency_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:20079538755470a25d919289-51178537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b37eb41ba0980cf4463422f72732aea7c659ed8e' => 
    array (
      0 => '../../app/www/views/sysmanager/agency_edit.html',
      1 => 1417802390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20079538755470a25d919289-51178537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a25d9744c1_48709226',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a25d9744c1_48709226')) {function content_5470a25d9744c1_48709226($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="title_panel">
	旅行社管理 - 新增旅行社
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="續約旅行社" onclick="self.location.href='index.php?ctr=sysagency';">
<input type="button" class="gm_t1_btn_alt_disabled" value="過期旅行社" onclick="self.location.href='index.php?ctr=sysagency&act=expired';">
<input type="button" class="gm_t1_btn" value="新增旅行社" onclick="self.location.href='index.php?ctr=sysagency&act=edit';">

<div class="form_inner">

<form action="index.php?ctr=sysagency&act=save" method="post" class="gm_t1_form">
    <ul>
        <li>
            <span class="v"><input type="text" id="name" name="name" placeholder="旅行社名稱"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="address" name="address" placeholder="地址"><em></em></span>
        </li>
        <!-- <li>
            <span class="v"><input type="text" id="" name="" placeholder="流水號"><em></em></span>
        </li> -->
        <li>
            <span class="v"><input type="text" id="code" name="code" placeholder="統一編號"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="contact" name="contact" placeholder="聯絡人"><em></em></span>
        </li>
        <li>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="電話"><em></em></span>
        </li>
        <li>
            <span class="v">
            	<input type="text" id="sign_date_start" name="sign_date_start" placeholder="選擇簽約开始日期" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)">
            </span>
        </li>
        <li>
            <span class="v">
            	<input type="text" id="sign_date_end" name="sign_date_end" placeholder="選擇簽約结束日期" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)">
            </span>
        </li>
        <li class="gm_t1_form_btn" style="height:auto;">
            <input type="submit" class="gm_t1_btn" value="提交">
        </li>
    </ul>
    <br /><br /><br /><br /><br /><br />
</form>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
