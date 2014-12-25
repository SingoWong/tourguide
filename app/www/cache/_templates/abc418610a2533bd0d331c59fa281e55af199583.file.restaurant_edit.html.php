<?php /* Smarty version Smarty-3.1.16, created on 2014-12-21 23:06:00
         compiled from "../../app/www/views/sysmanager/restaurant_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:4265926925470a35a4c6035-44905062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc418610a2533bd0d331c59fa281e55af199583' => 
    array (
      0 => '../../app/www/views/sysmanager/restaurant_edit.html',
      1 => 1419174357,
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

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="title_panel">
	餐廳管理 - 新增餐廳
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="續約餐廳" onclick="self.location.href='index.php?ctr=sysrestaurant';">
<input type="button" class="gm_t1_btn_alt_disabled" value="過期餐廳" onclick="self.location.href='index.php?ctr=sysrestaurant&act=expired';">
<input type="button" class="gm_t1_btn" value="新增餐廳" onclick="self.location.href='index.php?ctr=sysrestaurant&act=edit';">

<div class="form_inner">

<form action="index.php?ctr=sysrestaurant&act=save" method="post" class="gm_t1_form">
    <ul>
        <li>
        	<b>餐廳名稱：</b>
            <span class="v"><input type="text" id="name" name="name" placeholder="餐廳名稱"><em></em></span>
        </li>
        <li>
        	<b>發票抬頭：</b>
            <span class="v"><input type="text" id="title" name="title" placeholder="發票抬頭"><em></em></span>
        </li>
        <li>
        	<b>地址：</b>
            <span class="v"><input type="text" id="address" name="address" placeholder="地址"><em></em></span>
        </li>
        <!-- <li>
            <span class="v"><input type="text" id="" name="" placeholder="流水號"><em></em></span>
        </li> -->
        <li>
        	<b>統一編碼：</b>
            <span class="v"><input type="text" id="code" name="code" placeholder="統一編碼"><em></em></span>
        </li>
        <li>
        	<b>聯絡人：</b>
            <span class="v"><input type="text" id="contact" name="contact" placeholder="聯絡人"><em></em></span>
        </li>
        <li>
        	<b>電話：</b>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="電話"><em></em></span>
        </li>
        <li>
        	<b>選擇簽約開始日期：</b>
            <span class="v">
            	<input type="text" id="sign_date_start" name="sign_date_start" placeholder="選擇簽約开始日期" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)">
            </span>
        </li>
        <li>
        	<b>選擇全月結束日期：</b>
            <span class="v">
            	<input type="text" id="sign_date_end" name="sign_date_end" placeholder="選擇簽約结束日期" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)">
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
