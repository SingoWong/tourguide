<?php /* Smarty version Smarty-3.1.16, created on 2014-11-22 15:05:59
         compiled from "../../app/www/views/_common/navigation.html" */ ?>
<?php /*%%SmartyHeaderCode:20851875245470967b9605c9-98466674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53e0ed2ace70ba0089fb7510a1e1af712f7d4020' => 
    array (
      0 => '../../app/www/views/_common/navigation.html',
      1 => 1416668307,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20851875245470967b9605c9-98466674',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470967b963ea1_00733545',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470967b963ea1_00733545')) {function content_5470967b963ea1_00733545($_smarty_tpl) {?><div class="manager-nav">
	<div class="system_menu">
		<!-- <ul>
			<li class="snav_root_item">
				<a href="#">后台管理</a>
				<ul class="snav_child">
					<li class="snav_child_item">
						<a href="/index.php?Controller=SysModules&amp;action=Index">菜单管理</a></li>
					<li class="snav_child_item">
						<a href="/index.php?Controller=SysUsers&amp;action=Index">用户管理</a></li>
					<li class="snav_child_item">
						<a href="/index.php?Controller=SysRoles&amp;action=Index">权限管理</a></li>
				</ul>
			</li>
		</ul> -->
		
		<ul>
			<li class="snav_root_item">
				<a href="#">后台管理</a>
				<ul class="snav_child">
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency">旅行社管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysrestaurant">餐厅管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=syshotel">饭店管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysguide">导游管理</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysgroup">旅游团查询</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysreport">报表查询</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysaccident">意外通报</a></li>
				</ul>
			</li>
			
			<li class="snav_root_item">
				<a href="#">后台管理</a>
				<ul class="snav_child">
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=info">旅行社基本资料</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=groupedit">开新团</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=groupprogress">行程进度</a></li>
					<li class="snav_child_item"><a href="/index.php?ctr=sysagency&act=accident">意外通报</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div><?php }} ?>
