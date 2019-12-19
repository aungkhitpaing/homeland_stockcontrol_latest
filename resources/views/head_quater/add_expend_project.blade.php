@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1>
        Expend Data 
        <small>Preview of UI elements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Head_quater</a></li>
        <li class="active">Add_Expend</li>
      </ol>
    </section>

    <section class="content">
			<div class="row">
				<div class="col-md-12">
					<!-- Custom Tabs -->
				  	<div class="nav-tabs-custom">
				    	<ul class="nav nav-tabs">
		                  <li class="active">
							  <a href="#tab_2" data-toggle="tab">Project Expense</a>
							</li>
		              	</ul>

					    <div class="tab-content">


							<div>
								<section class="content">
										<div class="row">
											<div class="col-md-12">
												<!-- <div class="box box-info"> -->
													<div class="box-header with-border">
														<h3 class="box-title">Amount Form Project</h3>
										            </div>
										            <!-- form start -->
										            <form class="form-horizontal" method="POST" action="/head_quater/storeProjectExpend">
										            	{{ csrf_field() }}
										              	<div class="box-body">
										              	<div class="form-group">
									                  		<label for="investor_name" class="col-sm-2 control-label"> Account Head</label>
									                  		<div class="col-sm-10">
										                  		<!-- select -->
										                  		<select class="form-control" name="accountHead" required>
										                  			<option selected disabled value="">Select AccountHead</option>
										                  			@foreach($accountHeads as $accountHead)
										                  				<option value="{{$accountHead->id}}" required>{{$accountHead->account_head_type}}</option>
											                  		@endforeach
											                  	</select>
									                  		</div>
									                	</div>

										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Project Name</label>
										                  		<div class="col-sm-10">
											                  		<!-- select -->
											                  		<select required class="form-control" name="project">
																		<option disabled selected value="">Select project</option>
											                  		@foreach($getAllProjects as $getAllProject)
											                  			<option value="{{$getAllProject->id}}">{{$getAllProject->name}}</option>
											                  		@endforeach
												                  	</select>
										                  		</div>
										                	</div>

										                	<div class="radio">
										                    	<label style="margin-left: 17%;">
										                    		<input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
										                    		Cash
										                    	</label>
										                    	<label style="margin-left: 2%;">
										                      		<input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
										                      		Bank
										                    	</label>
										                  	</div>
										                	<br>
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="number" id="inputamount" name="amount" class="form-control">
											                			<span class="input-group-addon">.00</span>
											                		</div>
											                	</div>
											                </div>

											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Description</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
										                			  <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>
										                			</div>
										                		</div>
										                	</div>

										            	</div>
										            	<!-- /.box-body -->

										            	<div class="box-footer">
										                	<button type="submit" class="btn btn-info pull-right">Add Amount</button>
										              	</div>
										              	<!-- /.box-footer -->
										            </form>
										        <!-- </div> -->
										    </div>
										</div>
								</section>
							</div>							
				    	<!-- /.tab-content -->
				  	</div>
				  	<!-- nav-tabs-custom -->
				</div>
			<!-- /.col -->
			</div>
    </section>
@endsection
@section('page_scripts')
<script type="text/javascript">
	//Date picker
    $('#load_date').datepicker({
      autoclose: true
    })
    $('#with_draw').datepicker({
    	autoclose:true
    })
</script>
@endsection