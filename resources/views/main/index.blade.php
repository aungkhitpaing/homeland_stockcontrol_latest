@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->	
	<div class="row">
		<!-- <div class="col-lg-3 col-xs-6">

			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>150</h3>
					<p>New Orders</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>


		<div class="col-lg-3 col-xs-6">

			<div class="small-box bg-green">
				<div class="inner">
					<h3>53<sup style="font-size: 20px">%</sup></h3>
					<p>Bounce Rate</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>			


		<div class="col-lg-3 col-xs-6">

			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>44</h3>
					<p>User Registrations</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>


		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3>65</h3>
					<p>Unique Visitors</p>
				</div>

				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div> -->


<!-- Alert boxes (Stat box) -->	
	<div class="row">
		<div class="col-md-6">			
		  	<div class="box box-default">
	            <div class="box-header with-border">
	              <i class="fa fa-bullhorn"></i>
	              <h3 class="box-title">Total Income Cash Amount</h3>
	            </div>
	            <div class="box-body">
	            	<div class="callout callout-success">
			    		<h4> <span>Total Cash Amount is</span> <b>{{$getTotalIncomeCash}}</b> <span>Kyats</span></h4>
			    		<p>This is currently amount of cash</p>
			  		</div>
	            </div>
          	</div>
		</div>
		<div class="col-md-6">
			<div class="box box-default">
	            <div class="box-header with-border">
	              <i class="fa fa-bullhorn"></i>
	              <h3 class="box-title">Total Income Bank Amount</h3>
	            </div>
	            <div class="box-body">
	            	<div class="callout callout-success">
			    		<h4> <span>Total Bank Amount is</span> <b>{{$getTotalIncomeBank}}</b> <span>Kyats</span></h4>
			    		<p>This is currently amount of bank</p>
			  		</div>
	            </div>
          	</div>
		</div>
	</div>
<!-- /.row -->


<!-- Alert boxes (Stat box) -->	
	<div class="row">
		<div class="col-md-6">			
		  	<div class="box box-default">
	            <div class="box-header with-border">
	              <i class="fa fa-bullhorn"></i>
	              <h3 class="box-title">Total Expend Cash Amount</h3>
	            </div>
	            <div class="box-body">
	            	<div class="callout callout-danger">
			    		<h4> <span>Total Cash Amount is</span> <b> ( -{{$getTotalExpendCash}} )</b> <span>Kyats</span></h4>
			    		<p>This is currently amount of cash</p>
			  		</div>
	            </div>
          	</div>
		</div>
		<div class="col-md-6">
			<div class="box box-default">
	            <div class="box-header with-border">
	              <i class="fa fa-bullhorn"></i>
	              <h3 class="box-title">Total Expend Bank Amount</h3>
	            </div>
	            <div class="box-body">
	            	<div class="callout callout-danger">
			    		<h4> <span>Total Bank Amount is</span> <b> ( -{{$getTotalExpendBank}} )</b> <span>Kyats</span></h4>
			    		<p>This is currently amount of bank</p>
			  		</div>
	            </div>
          	</div>
		</div>
	</div>
<!-- /.row -->



	<div class="row">
		<div class="col-md-12">			
        	<div class="callout callout-warning">
	    		<h4> <span>Total Balance Amount is</span> <b>{{$balance}}</b> <span>Kyats</span></h4>
	    		<p>This is currently amount of cash</p>
	  		</div>
		</div>
	</div>


<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
				<li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
				<li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
			</ul>
			<div class="tab-content no-padding">
				<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
				<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
			</div>
		</div>
	</section>
	<!-- /.Left col -->
	
	
	<!-- right col (We are only adding the ID to make the widgets sortable)-->
	<section class="col-lg-5 connectedSortable">

<!-- Calendar -->
		<div class="box box-solid bg-green-gradient">
			<div class="box-header">
				<i class="fa fa-calendar"></i>
				<h3 class="box-title">Calendar</h3>
				<!-- tools box -->
				<div class="pull-right box-tools">
					<!-- button with a dropdown -->
					<div class="btn-group">
						<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bars"></i></button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Add new event</a></li>
							<li><a href="#">Clear events</a></li>
							<li class="divider"></li>
							<li><a href="#">View calendar</a></li>
						</ul>
			</div>
			<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
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
		</div>
<!-- /.box -->
</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->

@endsection
