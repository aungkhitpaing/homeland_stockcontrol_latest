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
		                  <li class="active"><a href="#tab_1" data-toggle="tab">Office Expense</a></li>
		                  <li><a href="#tab_2" data-toggle="tab">Project Expense</a></li>
		                  {{--<li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>--}}
		                  <li><a href="#tab_4" data-toggle="tab">PO</a></li>
		                  <li><a href="#tab_5" data-toggle="tab">PG</a></li>
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

							<div class="tab-pane" id="tab_2">
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
										                  			<option>Select AccountHead</option>
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
											                  		<select class="form-control" name="project">
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
										            		<button type="submit" class="btn btn-default">Cancel</button>
										                	<button type="submit" class="btn btn-info pull-right">Add Amount</button>
										              	</div>
										              	<!-- /.box-footer -->
										            </form>
										        <!-- </div> -->
										    </div>
										</div>
								</section>
							</div>							

							{{--<div class="tab-pane" id="tab_3">--}}
								{{--<section class="content">--}}
										{{--<div class="row">--}}
											{{--<div class="col-md-12">--}}
												{{--<!-- <div class="box box-info"> -->--}}
													{{--<div class="box-header with-border">--}}
														{{--<h3 class="box-title">Amount Form Bank Loan</h3>--}}
										            {{--</div>--}}
										            {{--<!-- form start -->--}}
										            {{--<form class="form-horizontal" method="POST" action="/head_quater/storeBankExpense">--}}
										            	{{--{{ csrf_field() }}--}}
										            	{{--<!-- <input type="hidden" name="accountHead" value="3" > -->--}}
										              	{{--<div class="box-body">--}}
											              	{{--<div class="form-group">--}}
										                  		{{--<label for="accounthead" class="col-sm-2 control-label"> Account Head</label>--}}
										                  		{{--<div class="col-sm-10">--}}
											                  		{{--<!-- select -->--}}
											                  		{{--<select class="form-control" name="accountHead" required>--}}

											                  			{{--<option>Select AccountHead</option>--}}
											                  			{{--@foreach($accountHeads as $accountHead)--}}
											                  				{{--<option value="{{$accountHead->id}}">{{$accountHead->account_head_type}}</option>--}}
												                  		{{--@endforeach--}}
												                  	{{--</select>--}}
										                  		{{--</div>--}}
										                	{{--</div>--}}

										                	{{--<div class="form-group">--}}
										                  		{{--<label for="investor_name" class="col-sm-2 control-label">Loan Payback For</label>--}}
										                  		{{--<div class="col-sm-10">--}}
											                  		{{--<select class="form-control" name="loan_transfer_id" required>--}}
											                  		{{--@foreach($getAllLoanTransfer as $getLoanTransfer)--}}
											                  			{{--<option value="{{$getLoanTransfer->id}}">{{$getLoanTransfer->description}}</option>--}}
											                  		{{--@endforeach--}}
												                  	{{--</select>--}}
										                  		{{--</div>--}}
										                	{{--</div>--}}

										                	{{--<div class="radio">--}}
										                    	{{--<label style="margin-left: 17%;">--}}
										                    		{{--<input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>--}}
										                    		{{--Cash--}}
										                    	{{--</label>--}}
										                    	{{--<label style="margin-left: 2%;">--}}
										                      		{{--<input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>--}}
										                      		{{--Bank--}}
										                    	{{--</label>--}}
										                  	{{--</div>--}}
										                	{{--<br>--}}

											                {{--<!-- Total loan amount -->--}}
											                {{--<div class="form-group">--}}
											                	{{--<label for="inputamount" class="col-sm-2 control-label">Payback Amount</label>--}}
											                	{{--<div class="col-sm-10">--}}
											                		{{--<div class="input-group">--}}
											                			{{--<span class="input-group-addon">$</span>--}}
											                			{{--<input type="text" id="inputamount" class="form-control" name="amount">--}}
											                			{{--<span class="input-group-addon">Kyats</span>--}}
											                		{{--</div>--}}
											                	{{--</div>--}}
											                {{--</div>--}}

											                {{--<!-- Loan Date -->--}}
															{{--<!-- <div class="form-group">--}}
																{{--<label for="inputamount" class="col-sm-2 control-label">Payback Date</label>--}}
																{{--<div class="col-sm-10">--}}
																	{{--<div class="input-group date">--}}
																		{{--<div class="input-group-addon">--}}
																			{{--<i class="fa fa-calendar"></i>--}}
																		{{--</div>--}}
																		{{--<input type="text" class="form-control pull-right" id="load_date" name="payback_date">--}}
																	{{--</div>--}}
																{{--</div>--}}
															{{--</div> -->--}}

											                {{--<div class="form-group">--}}
											                	{{--<label for="inputamount" class="col-sm-2 control-label">Description</label>--}}
											                	{{--<div class="col-sm-10">--}}
											                		{{--<div class="input-group">--}}
										                			  {{--<textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>--}}
										                			{{--</div>--}}
										                		{{--</div>--}}
										                	{{--</div>--}}
										            	{{--</div>--}}
										            	{{--<!-- /.box-body -->--}}

										            	{{--<div class="box-footer">--}}
										            		{{--<a href="/bank/" class="btn btn-default">Cancel</a>--}}
										                	{{--<button type="submit" class="btn btn-info pull-right">Add Amount</button>--}}
										              	{{--</div>--}}
										              	{{--<!-- /.box-footer -->--}}
										            {{--</form>--}}
										        {{--<!-- </div> -->--}}
										    {{--</div>--}}
										{{--</div>--}}
								{{--</section>--}}
							{{--</div>--}}

							<div class="tab-pane" id="tab_4">
								<section class="content">
									<div class="row">
									<div class="col-md-12">
										<!-- <div class="box box-info"> -->
											<div class="box-header with-border">
												<h3 class="box-title">Amount Form Payment Order</h3>
								            </div>
								            <!-- form start -->
								            <form class="form-horizontal" method="POST" action="/head_quater/storePaymentOrderExpend">
								            	{{ csrf_field() }}
								            	<input type="hidden" name="accountHead" value="4" >
								              	<div class="box-body">
								                	<div class="form-group">
								                  		<label for="investor_name" class="col-sm-2 control-label">Payment Order Name</label>
								                  		<div class="col-sm-10">
									                  		<select class="form-control" name="paymentorder" required>
									                  			@foreach($getAllPaymentOrder as $data)
									                  				<option value="{{$data->id}}">
									                  					{{$data->name}}
									                  				</option>
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
									                			<input type="text" id="inputamount" class="form-control" name="amount">
									                			<span class="input-group-addon">Kyats</span>
									                		</div>
									                	</div>
									                </div>

									                <div class="form-group">
									                	<label for="inputamount" class="col-sm-2 control-label">With Draw</label>
									                	<div class="col-sm-10">
															<div class="input-group date">
																<div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</div>
																<input type="text" class="form-control pull-right" id="with_draw" name="register_date">
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
								            		<button type="submit" class="btn btn-default">Cancel</button>
								                	<button type="submit" class="btn btn-info pull-right">Add Amount</button>
								              	</div>
								              	<!-- /.box-footer -->
								            </form>
								        <!-- </div> -->
								    </div>
								</div>
								</section>
							</div>
					      
							<div class="tab-pane" id="tab_5">
								
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