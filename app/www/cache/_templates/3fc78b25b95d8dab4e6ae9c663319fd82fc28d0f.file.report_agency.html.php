<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 15:15:51
         compiled from "../../app/www/views/sysmanager/report_agency.html" */ ?>
<?php /*%%SmartyHeaderCode:13040236755470a8a7051ae8-05988466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fc78b25b95d8dab4e6ae9c663319fd82fc28d0f' => 
    array (
      0 => '../../app/www/views/sysmanager/report_agency.html',
      1 => 1416669050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13040236755470a8a7051ae8-05988466',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a8a709a7e2_76906241',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a8a709a7e2_76906241')) {function content_5470a8a709a7e2_76906241($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	报表查询 - 旅行社
</div>

<input type="button" class="gm_t1_btn" value="旅行社" onclick="self.location.href='index.php?ctr=sysreport&act=agency';">
<input type="button" class="gm_t1_btn_alt_disabled" value="餐厅" onclick="self.location.href='index.php?ctr=sysreport&act=restaurant';">
<input type="button" class="gm_t1_btn_alt_disabled" value="饭店" onclick="self.location.href='index.php?ctr=sysreport&act=hotel';">
<input type="button" class="gm_t1_btn_alt_disabled" value="导游" onclick="self.location.href='index.php?ctr=sysreport&act=guide';">

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
