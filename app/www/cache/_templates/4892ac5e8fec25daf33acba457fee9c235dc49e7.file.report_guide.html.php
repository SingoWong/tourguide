<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 15:17:12
         compiled from "../../app/www/views/sysmanager/report_guide.html" */ ?>
<?php /*%%SmartyHeaderCode:2786135005470a8f8081fa9-16025405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4892ac5e8fec25daf33acba457fee9c235dc49e7' => 
    array (
      0 => '../../app/www/views/sysmanager/report_guide.html',
      1 => 1416669149,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2786135005470a8f8081fa9-16025405',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a8f80e64f3_06503503',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a8f80e64f3_06503503')) {function content_5470a8f80e64f3_06503503($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	报表查询 - 旅行社
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="旅行社" onclick="self.location.href='index.php?ctr=sysreport&act=agency';">
<input type="button" class="gm_t1_btn_alt_disabled" value="餐厅" onclick="self.location.href='index.php?ctr=sysreport&act=restaurant';">
<input type="button" class="gm_t1_btn_alt_disabled" value="饭店" onclick="self.location.href='index.php?ctr=sysreport&act=hotel';">
<input type="button" class="gm_t1_btn" value="导游" onclick="self.location.href='index.php?ctr=sysreport&act=guide';">

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
