<?php /* Smarty version Smarty-3.1.16, created on 2014-12-02 15:05:34
         compiled from "../../app/www/views/_common/navigation.html" */ ?>
<?php /*%%SmartyHeaderCode:20851875245470967b9605c9-98466674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53e0ed2ace70ba0089fb7510a1e1af712f7d4020' => 
    array (
      0 => '../../app/www/views/_common/navigation.html',
      1 => 1417532611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20851875245470967b9605c9-98466674',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470967b963ea1_00733545',
  'variables' => 
  array (
    'RBAC_ROLE_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470967b963ea1_00733545')) {function content_5470967b963ea1_00733545($_smarty_tpl) {?><div class="manager-nav">
	<div class="system_menu">
		<ul>
			<?php if ($_smarty_tpl->tpl_vars['RBAC_ROLE_NAME']->value=='管理员') {?>
			<li class="snav_root_item">
				<a href="#">後台管理</a>
				<ul class="snav_child">
					<!-- <li class="snav_child_item"><a href="/index.php?ctr=sysusers">管理员管理</a></li> -->
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency">旅行社管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysrestaurant">餐廳管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=syshotel">飯店管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysguide">導遊管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysgroup">旅行團查詢</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysreport">報表查詢</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysaccident">意外通報</a></li>
				</ul>
			</li>
			<?php } elseif ($_smarty_tpl->tpl_vars['RBAC_ROLE_NAME']->value=='旅行社') {?>
			<li class="snav_root_item">
				<a href="#">後台管理</a>
				<ul class="snav_child">
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=info">旅行社基本資料</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=groupedit">開新團</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=groupprogress">行程進度</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=accident">意外通報</a></li>
				</ul>
			</li>
			<?php }?>
		</ul>
	</div>
</div><?php }} ?>
