<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 15:06:00
         compiled from "../../app/www/views/sysmanager/group_history.html" */ ?>
<?php /*%%SmartyHeaderCode:2634010085470a658e071c7-82687027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '788e346b0ee6f48ad8b3a1a80ccf5da9ec1898a5' => 
    array (
      0 => '../../app/www/views/sysmanager/group_history.html',
      1 => 1416668742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2634010085470a658e071c7-82687027',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a658e63bf9_99290366',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a658e63bf9_99290366')) {function content_5470a658e63bf9_99290366($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	旅游团查询 - 历史查询
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="旅行团进度" onclick="self.location.href='index.php?ctr=sysgroup';">
<input type="button" class="gm_t1_btn" value="历史查询" onclick="self.location.href='index.php?ctr=sysgroup&act=history';">

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
