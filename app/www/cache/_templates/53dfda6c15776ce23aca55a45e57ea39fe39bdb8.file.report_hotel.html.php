<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 15:17:11
         compiled from "../../app/www/views/sysmanager/report_hotel.html" */ ?>
<?php /*%%SmartyHeaderCode:19902602815470a8f7437ca2-94603576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53dfda6c15776ce23aca55a45e57ea39fe39bdb8' => 
    array (
      0 => '../../app/www/views/sysmanager/report_hotel.html',
      1 => 1416669129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19902602815470a8f7437ca2-94603576',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a8f74b2db1_71192308',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a8f74b2db1_71192308')) {function content_5470a8f74b2db1_71192308($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	报表查询 - 旅行社
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="旅行社" onclick="self.location.href='index.php?ctr=sysreport&act=agency';">
<input type="button" class="gm_t1_btn_alt_disabled" value="餐厅" onclick="self.location.href='index.php?ctr=sysreport&act=restaurant';">
<input type="button" class="gm_t1_btn" value="饭店" onclick="self.location.href='index.php?ctr=sysreport&act=hotel';">
<input type="button" class="gm_t1_btn_alt_disabled" value="导游" onclick="self.location.href='index.php?ctr=sysreport&act=guide';">

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
