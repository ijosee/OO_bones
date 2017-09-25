<!-- Custom load resources -->
<script src="<?php echo base_url('assets/dist/admin/select_2/js/select2.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/admin_pos.js');?>"></script>


<div class="row">

	<div class="col-xs-5">
	
	<?php 
	 echo modules::run('adminlte/sand/comp_widget_sand'); ?>
	</div>

	<div class="col-xs-7">
	<?php echo modules::run('adminlte/sand/comp_widget_sand_large'); ?>
	</div>

</div>

