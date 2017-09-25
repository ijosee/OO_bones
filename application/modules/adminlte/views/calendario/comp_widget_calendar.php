<!-- Calendar -->
<div class="box box-solid bg-green-gradient">
	<div class="box-header">
		<i class="fa fa-calendar"></i>

		<h3 class="box-title">Calendario</h3>
		<!-- tools box -->
		<div class="pull-right box-tools">
			<!-- button with a dropdown -->
			<div class="btn-group">
				<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bars"></i>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#">Crear evento</a></li>
					<li><a href="#">Limpiar eventos</a></li>
					<li class="divider"></li>
					<li><a href="#">Ver calendario</a></li>
				</ul>
			</div>
			<button type="button" class="btn btn-success btn-sm"
				data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-success btn-sm"
				data-widget="remove">
				<i class="fa fa-times"></i>
			</button>
		</div>
		<!-- /. tools -->
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<!--The calendar -->
		<div id="calendar" style="width: 100%"></div>
	</div>
	<!-- /.box-body -->
	<div class="box-footer text-black">
		<div class="row">
			<div class="col-sm-6">
				<!-- Progress bars -->
				<div class="clearfix">
					<span class="pull-left">Tarea 1</span> <small class="pull-right">90%</small>
				</div>
				<div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 90%;"></div>
				</div>

				<div class="clearfix">
					<span class="pull-left">Tarea #2</span> <small class="pull-right">70%</small>
				</div>
				<div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 70%;"></div>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<div class="clearfix">
					<span class="pull-left">Tarea #3</span> <small class="pull-right">60%</small>
				</div>
				<div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 60%;"></div>
				</div>

				<div class="clearfix">
					<span class="pull-left">Tarea #4</span> <small class="pull-right">40%</small>
				</div>
				<div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 40%;"></div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
</div>
<!-- /.box -->