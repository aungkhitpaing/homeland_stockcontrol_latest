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
		                  <li>Office Expense</a></li>
		                  <li><a href="#tab_2" data-toggle="tab">Project Expense</a></li>
		                  {{--<li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>--}}
		                  <li><a href="#tab_4" data-toggle="tab">PO</a></li>
		                  {{--<li><a href="#tab_5" data-toggle="tab">PG</a></li>--}}
		                  <!-- <li><a href="#tab_6" data-toggle="tab">Interest Paid</a></li> -->
		                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
		              	</ul>

					    <div class="tab-content">

					    	<div class="tab-pane active" id="tab_1">
					    		<section class="content">
					    			<div class="row">
						    			<div class="col-md-12">
						    				<!-- <div class="box box-info"> -->
						    					<div class="box-header with-border">
						    						<h3 class="box-title">Daily Expense Amount</h3>
									            </div>
									            <!-- form start -->
									            <form class="form-horizontal" method="POST" action="/head_quater/storeDailyExpend">
										            	{{ csrf_field() }}
										            	<!-- <input type="hidden" name="accountHead" value="6" > -->
										              	<div class="box-body">

										              	<div class="form-group">
									                  		<label for="investor_name" class="col-sm-2 control-label"> Account Head</label>
									                  		<div class="col-sm-10">
										                  		<!-- select -->
																<select class="form-control" name="accountHead" required>
																	<option>Select AccountHead</option>
																	@foreach($accountHeads as $accountHead)
																		<option value="{{$accountHead->id}}" required>{{$accountHead->account_head_type}}</option>
																	@endforeach
																</select>
									                  		</div>
									                	</div>

										              	<div class="form-group">
									                  		<label for="investor_name" class="col-sm-2 control-label"> Expend Category</label>
									                  		<div class="col-sm-10">
										                  		<!-- select -->
										                  		<select class="form-control" name="dailyexpend" required>
										                  			<option>select daily expense</option>
										                  			@foreach($getAllExpenseCategories as $getAllExpenseCategory)
																		<option value="{{$getAllExpenseCategory->id}}" required>{{$getAllExpenseCategory->expense_category_name}}</option>							
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
											                <!-- Total loan amount -->
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Expend Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control" name="amount">
											                			<span class="input-group-addon">Kyats</span>
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
										            		<a href="/bank/" class="btn btn-default">Cancel</a>
										                	<button type="submit" class="btn btn-info pull-right">Add Amount</button>
										              	</div>
										              	<!-- /.box-footer -->
										            </form>
									        <!-- </div> -->
									    </div>
					    			</div>
					    		</section>
					    	</div>
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