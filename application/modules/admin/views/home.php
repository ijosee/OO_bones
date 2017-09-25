<!-- Custom load resources -->
<script src="<?php echo base_url('assets/dist/admin/admin_home.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/chart/Chart.min.js');?>"></script>


<div class="row">

	<div class="col-lg-3 col-xs-6">
		<?php echo modules::run('adminlte/box/comp_widget_static_box','green','10%','Incremento','ion ion-stats-bars','#'); ?>
	</div>
	<div class="col-lg-3 col-xs-6">
		<?php echo modules::run('adminlte/box/comp_widget_static_box','red','20 Nuevo','Clientes','ion ion-person-add','#'); ?>
	</div>
	<div class="col-lg-3 col-xs-6">
		<?php echo modules::run('adminlte/box/comp_widget_static_box','blue','75%','Tareas Cumplidas','ion ion-pie-graph','#'); ?>
	</div>
	<div class="col-lg-3 col-xs-6">
		<?php echo modules::run('adminlte/box/comp_widget_static_box','orange','100 €','Ventas','fa fa-shopping-cart','#'); ?>
	</div>

</div>

<div class="row">
	<div class="col-lg-12">
		<?php echo modules::run('adminlte/graph/comp_widget_graph')?>
	</div>
</div>


<div class="row">
	<div class="col-lg-3 col-xs-6">
		<?php echo modules::run('adminlte/calendario/comp_widget_calendar')?>
	</div>

	<div class="col-lg-9 col-xs-6">
		<?php echo modules::run('adminlte/box/comp_widget_box_task','Todo\'s','tareas')?>
	</div>
</div>



<!-- 	<div class="col-md-4"> -->
<?php //echo modules::run('adminlte/widget/box_open', 'Shortcuts'); ?>
			<?php //echo modules::run('adminlte/widget/app_btn', 'fa fa-user', 'Account', 'panel/account'); ?>
			<?php //echo modules::run('adminlte/widget/app_btn', 'fa fa-sign-out', 'Logout', 'panel/logout'); ?>
		<?php //echo modules::run('adminlte/widget/box_close'); ?>
<!-- 	</div> -->

<!-- 	<div class="col-md-12"> -->
<?php //echo modules::run('adminlte/InfoWidget/dashboard_info_box', 'red'); ?>
<!-- 	</div> -->


<!-- 	<div class="col-md-12"> -->
<?php //echo modules::run('adminlte/widget/map_box'); ?>
<!-- 	</div> -->

<!-- 	<div class="col-md-12"> -->
<?php //echo modules::run('adminlte/widget/lastest_orders_box','red'); ?>

<!-- 	</div> -->

