<?php /* Smarty version Smarty-3.1.16, created on 2014-12-10 17:42:38
         compiled from "../../app/www/views/sysmanager/restaurant_renewal.html" */ ?>
<?php /*%%SmartyHeaderCode:7472650105488860e1a3b98-19733737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6989eb16bf69a041d0f1c9d208d31366fb021bf3' => 
    array (
      0 => '../../app/www/views/sysmanager/restaurant_renewal.html',
      1 => 1417811851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7472650105488860e1a3b98-19733737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'uid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5488860e238f36_51180413',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5488860e238f36_51180413')) {function content_5488860e238f36_51180413($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="title_panel">
	餐廳管理 - 續約
</div>

<div class="form_inner">

<form action="index.php?ctr=sysrestaurant&act=saveprofile" method="post" class="gm_t1_form">
    <ul>
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
        	<input type="hidden" name="type" value="renewal" />
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" />
            <input type="submit" class="gm_t1_btn" value="提交">
        </li>
    </ul>
</form>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/popup_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
