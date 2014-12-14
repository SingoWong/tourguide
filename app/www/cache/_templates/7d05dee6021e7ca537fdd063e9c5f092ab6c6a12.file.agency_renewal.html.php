<?php /* Smarty version Smarty-3.1.16, created on 2014-12-05 19:31:52
         compiled from "../../app/www/views/sysmanager/agency_renewal.html" */ ?>
<?php /*%%SmartyHeaderCode:444399189548201d4524220-96970505%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d05dee6021e7ca537fdd063e9c5f092ab6c6a12' => 
    array (
      0 => '../../app/www/views/sysmanager/agency_renewal.html',
      1 => 1417807902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '444399189548201d4524220-96970505',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_548201d45bedf8_14013721',
  'variables' => 
  array (
    'uid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548201d45bedf8_14013721')) {function content_548201d45bedf8_14013721($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/popup_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="title_panel">
	旅行社管理 - 續約
</div>

<div class="form_inner">

<form action="index.php?ctr=sysagency&act=saveprofile" method="post" class="gm_t1_form">
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
