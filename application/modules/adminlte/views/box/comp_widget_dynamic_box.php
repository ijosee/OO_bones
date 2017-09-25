<div class="col-md-3">
	<div class="box box-<?php echo $color?>">
		<div class="box-header">
			<h3 class="box-title">$title</h3>
		</div>
		<div class="box-body">$body</div>
		<!-- /.box-body -->
		<?php if($isLoading):?>
		<!-- Loading (remove the following to stop the loading)-->
		<div class="overlay">
			<i class="fa fa-refresh fa-spin"></i>
		</div>
		<!-- end loading -->
		<?php endif ?>
	</div>
	<!-- /.box -->
</div>
<!-- /.col -->
