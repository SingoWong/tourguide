<?php /* Smarty version Smarty-3.1.16, created on 2014-12-23 14:53:00
         compiled from "../../app/www/views/agency/guide_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:5189288854990f04833cb6-76954838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2b36928b0133d0ea28a586e67cf41fee73cb2e6' => 
    array (
      0 => '../../app/www/views/agency/guide_edit.html',
      1 => 1419317017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5189288854990f04833cb6-76954838',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54990f04899318_99147787',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54990f04899318_99147787')) {function content_54990f04899318_99147787($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="title_panel">
	導遊管理 - 新增導遊
</div>

<div class="form_inner">

<form action="index.php?ctr=sysagency&act=guidesave" method="post" class="gm_t1_form">
    <ul>
        <li>
        	<b>導遊名稱：</b>
            <span class="v"><input type="text" id="name" name="name" placeholder="導遊名稱"><em></em></span>
        </li>
        <li>
        	<b>電話：</b>
            <span class="v"><input type="text" id="contact_tel" name="contact_tel" placeholder="電話"><em></em></span>
        </li>
        <!--<li>
            <span class="v"><input type="text" id="" name="" placeholder="流水號"><em></em></span>
        </li>-->
        <li>
        	<b>導遊證號：</b>
            <span class="v"><input type="text" id="code" name="code" placeholder="統一編碼"><em></em></span>
        </li>
        <li>
        	<b>選擇簽約開始日期：</b>
            <span class="v">
            	<input type="text" id="sign_date_start" name="sign_date_start" placeholder="選擇簽約开始日期" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)">
            </span>
        </li>
        <li>
        	<b>選擇簽約結束日期：</b>
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

<?php echo $_smarty_tpl->getSubTemplate ("_common/popup_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
