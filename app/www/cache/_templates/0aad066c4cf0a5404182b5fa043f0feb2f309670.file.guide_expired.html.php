<?php /* Smarty version Smarty-3.1.16, created on 2014-11-23 18:52:05
         compiled from "../../app/www/views/sysmanager/guide_expired.html" */ ?>
<?php /*%%SmartyHeaderCode:2507885575470a478784721-51624274%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0aad066c4cf0a5404182b5fa043f0feb2f309670' => 
    array (
      0 => '../../app/www/views/sysmanager/guide_expired.html',
      1 => 1416768621,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2507885575470a478784721-51624274',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a4788086b9_94631528',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a4788086b9_94631528')) {function content_5470a4788086b9_94631528($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<style type="text/css">
.item {
	border: 1px solid #CCC;
	margin-bottom: 10px;
}
.item .item_title {
	background: #2288CC;
	height: 30px;
	line-height: 30px;
	padding-left: 10px;
	font-weight: bold;
}
.item .item_title a {
	float: right;
	display: block;
	width: 50px;
	height:30px;
	background: #002166;
	text-align: center;
	color: #FFF;
}
.item .item_content table {
	background: #CCC;
}
.item .item_content table tr td {
	background: #FFF;
	height: 25px;
	line-height: 25px;
	padding: 3px;;
}
.item .item_content table tr td a {
	text-align: center;
	display: block;
}
.item .item_content .item_footer {
	height: 30px;
	line-height: 30px;
	padding-left: 10px;
}
.item .item_content .item_footer a {
	float: right;
	display: block;
	width: 50px;
	background: #002166;
	text-align: center;
	color: #FFF;
	font-weight: bold;
}
</style>
<script type="text/javascript">
function sh_pnlc(id) {
	if ($("#pnlc_"+id).css("display") == "none") {
		$("#pnlc_"+id).show();
		$("#btnc_"+id).htm("关闭");
	} else {
		$("#pnlc_"+id).hide();
		$("#btnc_"+id).htm("展开");
	}
	return false;
}
</script>

<div class="title_panel">
	导游管理 - 过期导游
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="续约导游" onclick="self.location.href='index.php?ctr=sysguide';">
<input type="button" class="gm_t1_btn" value="过期导游" onclick="self.location.href='index.php?ctr=sysguide&act=expired';">
<input type="button" class="gm_t1_btn_alt_disabled" value="新增导游" onclick="self.location.href='index.php?ctr=sysguide&act=edit';">

<div class="search-inner">
<form class="gm_t1_form" id="reg_form" action="" method="GET">
	<input type="hidden" name="ctr" value="sysagency" />
	<input type="hidden" name="act" value="index" />
	<label class="v"><input id="name" type="text" name="name" value="" placeholder="导游"></label>
	<label class="v"><input id="username" type="text" name="username" value="" placeholder="帐号"></label>
	<label class="s"><input type="submit" class="gm_t1_btn" value="搜索" /></label>	
</form>
</div>

<div class="list_inner">
	
	<!-- foreach -->
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<div class="item">
		<div class="item_title">
			<a href="#" onclick="return sh_pnlc(<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
);" id="btnc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">关闭</a>
			<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
 签约日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_start,'%Y-%m-%d');?>
 至 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_end,'%Y-%m-%d');?>

		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			<table border="0" width="100%" cellpadding="2" cellspacing="1">
				<tr>
					<td colspan="2">帐号：<?php echo $_smarty_tpl->tpl_vars['item']->value->username;?>
</td>
					<td>密码：******</td>
					<td width="10%"><a href="">重置密码</a></td>
				</tr>
				<tr>
					<td colspan="2">导游名称：<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</td>
					<td>电话：<?php echo $_smarty_tpl->tpl_vars['item']->value->contact_tel;?>
</td>
					<td><a href="#">修改</a></td>
				</tr>
				<tr>
					<td colspan="2" width="50%">流水号：<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
</td>
					<td colspan="2" width="50%">统一编码：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
</td>
				</tr>
				<tr>
					<td colspan="2">上月接团总数：</td>
					<td colspan="2">本月接团总数：</td>
				</tr>
			</table>
			<div class="item_footer">
				<a href="">续约</a>
				<a href="">停权</a>
				签约日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_start,'%Y-%m-%d');?>
 至 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_end,'%Y-%m-%d');?>

			</div>
		</div>
	</div>
	<?php } ?>
	<!-- foreach -->
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
