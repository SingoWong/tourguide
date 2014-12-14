<?php /* Smarty version Smarty-3.1.16, created on 2014-12-09 14:48:13
         compiled from "../../app/www/views/agency/group_edit_schedule.html" */ ?>
<?php /*%%SmartyHeaderCode:2314181265478897dad71a9-69216105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47b8520c6b6d11e208662e1a4791b614875c01a9' => 
    array (
      0 => '../../app/www/views/agency/group_edit_schedule.html',
      1 => 1418136394,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2314181265478897dad71a9-69216105',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5478897dbe8b70_71013937',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
    'html_hotel' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5478897dbe8b70_71013937')) {function content_5478897dbe8b70_71013937($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript">
var curday = new Array();
var curroute = new Array();
$(document).ready(function(){
	//初始化
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	if (curday[<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
] != '1') {
		add_day(<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
);
		
		curday[<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
] = '1';
		curroute[<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
+'_1'] = '1';
	}
	
	if (curroute[<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
+'_'+<?php echo $_smarty_tpl->tpl_vars['item']->value->route;?>
] != '1') {
		add_route(<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
);
		
		curroute[<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
+'_'+<?php echo $_smarty_tpl->tpl_vars['item']->value->route;?>
] = '1';
	}
	
	$("#type_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val("<?php echo $_smarty_tpl->tpl_vars['item']->value->type;?>
");
	$("#time_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val('<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->time,"%H:%M");?>
');
	$("#location_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val("<?php echo $_smarty_tpl->tpl_vars['item']->value->location;?>
");
	$("#hid_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val("<?php echo $_smarty_tpl->tpl_vars['item']->value->hid;?>
");
	$("#money_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val("<?php echo $_smarty_tpl->tpl_vars['item']->value->money;?>
");
	$("#detail_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t).val("<?php echo $_smarty_tpl->tpl_vars['item']->value->detail;?>
");
	
	change_type($("#type_<?php echo $_smarty_tpl->tpl_vars['item']->value->day;?>
_"+t)[0]);
	
	<?php } ?>
});

var t = 0;
var count_days = 0;
var curr_day = 0;
var type_list = '<option value="0">機</option><option value="1">景</option><option value="2">中</option><option value="3">晚</option><option value="4">住</option>';
var hotel_list = '<?php echo $_smarty_tpl->tpl_vars['html_hotel']->value;?>
';

function add_day() {
	count_days++;
	var html_btnday = '<input type="button" class="gm_t1_btn_alt_disabled" value="第'+count_days+'天" onclick="change_day('+count_days+');" />\n';
	var html_pnlday = '<div id="day_'+count_days+'" class="day_item"><div id="day_'+count_days+'_items" class="item"></div><div><input type="button" class="gm_t1_btn" value="+增加行程" onclick="add_route('+count_days+');"></div></div><input type="hidden" name="days[]" value="'+count_days+'" />';
	$("#list_days").append(html_btnday);
	$("#list_route").append(html_pnlday);
	
	change_day(count_days);
	add_route(count_days);
}
function add_route(day) {
	t++;
	var html_route = '<div id="route_'+day+'_'+t+'"><div class="item_title"><a href="#" onclick="return close_route('+day+','+t+');" id="btnc_'+day+''+t+'">X</a>行程<em class="route_'+day+'_num"><em></div>'+
	 				 '<table border="0" width="100%" cellpadding="2" cellspacing="1">'+
	 				 '<tr><td class="i_type">'+
	 				 '<select name="type_'+day+'[]" id="type_'+day+'_'+t+'" day="'+day+'" t="'+t+'" onchange="change_type(this);">'+
	 				 type_list+
	 				 '</select></td>'+
	 				 '<td class="i_time"><input type="text" name="time_'+day+'[]" id="time_'+day+'_'+t+'" day="'+day+'" placeholder="時間" /></td>'+
	 				 '<td class="i_other">'+
	 				 '<div id="i_type_'+day+'_location_'+t+'"><input type="text" name="location_'+day+'[]" id="location_'+day+'_'+t+'" day="'+day+'" placeholder="地点" /></div>'+
	 				 '<div id="i_type_'+day+'_hotel_'+t+'" style="display:none"><select name="hid_'+day+'[]" id="hid_'+day+'_'+t+'" day="'+day+'" class="hotel_list">'+hotel_list+'</select>&nbsp;<input type="text" name="money_'+day+'[]" id="money_'+day+'_'+t+'" day="'+day+'" placeholder="金额" /></div>'+
	 				 '</td></tr><tr>'+
	 				 '<td colspan="3" class="i_detail"><textarea name="detail_'+day+'[]" id="detail_'+day+'_'+t+'"></textarea></td></tr></table></div>';
	$("#day_"+day+"_items").append(html_route);
	
	fix_route_num(day);
}
function close_route(day, t) {
	$("#route_"+day+"_"+t).remove();
	fix_route_num(day);
}
function change_day(day) {
	if (curr_day == day) {
		return;
	}
	$("#day_"+day).show();
	$("#day_"+curr_day).hide();
	curr_day = day;
}
function change_type(sender) {
	var o = $(sender);
	if (o.val() == "4") {
		$("#i_type_"+o.attr("day")+"_location_"+o.attr("t")).hide();
		$("#i_type_"+o.attr("day")+"_hotel_"+o.attr("t")).show();
	} else {
		$("#i_type_"+o.attr("day")+"_location_"+o.attr("t")).show();
		$("#i_type_"+o.attr("day")+"_hotel_"+o.attr("t")).hide();
	}
}
function fix_route_num(day) {
	$(".route_"+day+"_num").each(function(i){
		$(this).html(i+1);
	});
}
</script>

<div class="flowset">
	<a href="index.php?ctr=sysagency&act=groupedit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">旅行社的基本資料</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=grouproom&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">分房資訊</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupschedule&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="curr">行程安排</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupinfo&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">開團說明會資料</a>
</div>

<form method="post" action="index.php?ctr=sysagency&act=groupschedulesave">
<div class="title_panel">
	行程安排
</div>
<div class="date_select">
	<span id="list_days"></span>
	<input type="button" class="gm_t1_btn" value="+" onclick="add_day();">
</div>

<div class="form_inner" id="list_route">
	
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
