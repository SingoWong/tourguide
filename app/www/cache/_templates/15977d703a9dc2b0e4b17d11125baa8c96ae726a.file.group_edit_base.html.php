<?php /* Smarty version Smarty-3.1.16, created on 2014-12-06 06:42:13
         compiled from "../../app/www/views/agency/group_edit_base.html" */ ?>
<?php /*%%SmartyHeaderCode:15720755635474907282df07-87166571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15977d703a9dc2b0e4b17d11125baa8c96ae726a' => 
    array (
      0 => '../../app/www/views/agency/group_edit_base.html',
      1 => 1417848130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15720755635474907282df07-87166571',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5474907288b058_86256540',
  'variables' => 
  array (
    'id' => 0,
    'row' => 0,
    'RBAC_USER_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5474907288b058_86256540')) {function content_5474907288b058_86256540($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<div class="flowset">
	<a href="index.php?ctr=sysagency&act=groupedit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="curr">旅行社的基本資料</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=grouproom&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">分房資訊</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupschedule&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">行程安排</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupinfo&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">開團說明會資料</a>
</div>

<form method="post" action="index.php?ctr=sysagency&act=groupsave">
<div class="title_panel">
	基本資料
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">團號</td>
			<td><span class="v"><input type="text" id="code" name="code" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->code;?>
"></span></td>
			<td class="tf_key">團名</td>
			<td><span class="v"><input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->name;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">系列團型</td>
			<td><span class="v"><input type="text" id="gcode" name="gcode" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->gcode;?>
"></span></td>
			<td class="tf_key">天數</td>
			<td><span class="v"><input type="text" id="days" name="days" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->days;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">洲別</td>
			<td><span class="v"><input type="text" id="continent" name="continent" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->continent;?>
"></span></td>
			<td class="tf_key">國家</td>
			<td><span class="v"><input type="text" id="country" name="country" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->country;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">城市</td>
			<td><span class="v"><input type="text" id="city" name="city" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->city;?>
"></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
	</table>
</div>

<div class="title_panel">
	航班訊息
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">出國日期</td>
			<td><span class="v"><input type="text" id="start_date" name="start_date" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->start_date;?>
" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">班機行程</td>
			<td><span class="v"><input type="text" id="start_flight_code" name="start_flight_code" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->start_flight_code;?>
"></span></td>
			<td class="tf_key">起飛時間</td>
			<td><span class="v"><input type="text" id="start_departure_time" name="start_departure_time" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->start_departure_time;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">班機代碼</td>
			<td><span class="v"><input type="text" id="start_flight_num" name="start_flight_num" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->start_flight_num;?>
"></span></td>
			<td class="tf_key">抵達時間</td>
			<td><span class="v"><input type="text" id="start_arrive_time" name="start_arrive_time" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->start_arrive_time;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">回國日期</td>
			<td><span class="v"><input type="text" id="end_date" name="end_date" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->end_date;?>
" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">班機行程</td>
			<td><span class="v"><input type="text" id="end_flight_code" name="end_flight_code" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->end_flight_code;?>
"></span></td>
			<td class="tf_key">起飛時間</td>
			<td><span class="v"><input type="text" id="end_departure_time" name="end_departure_time" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->end_departure_time;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">班機代碼</td>
			<td><span class="v"><input type="text" id="end_flight_num" name="end_flight_num" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->end_flight_num;?>
"></span></td>
			<td class="tf_key">抵達時間</td>
			<td><span class="v"><input type="text" id="end_arrive_time" name="end_arrive_time" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->end_arrive_time;?>
"></span></td>
		</tr>
	</table>
</div>

<div class="title_panel">
	開團資訊
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">開團OP</td>
			<td><span class="v"><input type="text" id="op" name="op" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->op;?>
"></span></td>
			<td class="tf_key">團員人數</td>
			<td><span class="v"><input type="text" id="amount" name="amount" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->amount;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">旅行社</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['RBAC_USER_NAME']->value;?>
</span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">聯絡人</td>
			<td><span class="v"><input type="text" id="contact_name" name="contact_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->contact_name;?>
"></span></td>
			<td class="tf_key">聯絡電話</td>
			<td><span class="v"><input type="text" id="contact_tel" name="contact_tel" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->contact_tel;?>
"></span></td>
		</tr>
	</table>
</div>

<hr size="1" />
<div>
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
	<input type="submit" class="gm_t1_btn" value="提交訊息">
</div>
</form>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
