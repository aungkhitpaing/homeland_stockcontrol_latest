@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1>
        Income Data 
        <small>Preview of UI elements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Head_quater</a></li>
        <li class="active">Add_Income</li>
      </ol>
    </section>

    <section class="content">
			<div class="row">
				<div class="col-md-12">
					<!-- Custom Tabs -->
				  	<div class="nav-tabs-custom">
				    
				    	<ul class="nav nav-tabs">
				    		<li class="active"><a href="#tab_1" data-toggle="tab">Investor</a></li>
		                  	<li><a href="#tab_2" data-toggle="tab">Project</a></li>
		                  	<li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>
		                  	{{--<li><a href="#tab_4" data-toggle="tab">PO</a></li>--}}
		                  	<li><a href="#tab_6" data-toggle="tab">PG</a></li>
		                  	<!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li>		                  	 -->
					      	<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
					    </ul>

					    <div class="tab-content">

					    	<!-- Investor tab-pane -->
					    	<div class="tab-pane active" id="tab_1">
					    		<section class="content">
					    			<div class="row">
						    			<div class="col-md-12">
						    				<!-- <div class="box box-info"> -->
						    					<div class="box-header with-border">
						    						<h3 class="box-title">Amount Form Investor</h3>
									            </div>
									            <!-- form start -->
									            <form class="form-horizontal" method="POST" action="/head_quater/storeInvestorIncome">
									            	{{ csrf_field() }}
									              	<div class="box-body">
									              		<input type="hidden" name="accountHead" value="1" >
									                	<div class="form-group">
									                  		<label for="investor_name" class="col-sm-2 control-label">Investor Name</label>
									                  		<div class="col-sm-10">
										                  		<!-- select -->
										                  		<select class="form-control" name="investor" required>
										                  			<option>-----select investor-----</option>
										                  			@foreach($investors as $investor)
										                  				<option value="{{$investor->id}}">{{$investor->name}}</option>
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
										                			<input type="number" name="amount" id="inputamount" class="form-control" required>
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
									            		<a href="/head_quater" class="btn btn-default">Cancel</a>
									                	<input type="submit" class="btn btn-info pull-right" value="Add Amount">
									              	</div>
									              	<!-- /.box-footer -->
									            </form>
									        <!-- </div> -->
									    </div>
					    			</div>
					    		</section>
					    	</div>
					    	<!-- /.Investor tab-pane -->

					    	<!-- Project tab-pane -->
							<div class="tab-pane" id="tab_2">
								<section class="content">
										<div class="row">
											<div class="col-md-12">
												<!-- <div class="box box-info"> -->
													<div class="box-header with-border">
														<h3 class="box-title">Amount Form Project</h3>
										            </div>
										            <!-- form start -->
										            <form class="form-horizontal" method="POST" action="/head_quater/storeProjectIncome">
										            {{ csrf_field() }}
										            <input type="hidden" name="accountHead" value="2" >
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Project Name</label>
										                  		<div class="col-sm-10">
											                  		<select class="form-control" name="project" required>
																		<option>-----select project-----</option>
										                  			@foreach($projects as $project)
										                  				<option value="{{$project->id}}">{{$project->name}}</option>
											                  		@endforeach
												                  	</select>
										                  		</div>
										                	</div>
										                	<div class="radio">
										                    	<label style="margin-left: 17%;">
										                    		<input type="radio" name="optionsRadios" id="optionsRadios1" value="cash" required>
										                    		Cash
										                    	</label>
										                    	<label style="margin-left: 2%;">
										                      		<input type="radio" name="optionsRadios" id="optionsRadios2" value="bank" required>
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
										            		<a href="/head_quater" class="btn btn-default">Cancel</a>
										                	<input type="submit" class="btn btn-info pull-right" value="Add Amount">
										              	</div>
										              	<!-- /.box-footer -->
										            </form>
										        <!-- </div> -->
										    </div>
										</div>
								</section>
							</div>
							<!-- /. Project tab-pane -->
							
							<!-- BankLoan tab-pane -->
							<div class="tab-pane" id="tab_3">
								<section class="content">
										<div class="row">
											<div class="col-md-12">
												<!-- <div class="box box-info"> -->
													<div class="box-header with-border">
														<h3 class="box-title">Amount Form Bank Loan</h3>
										            </div>
										            <!-- form start -->
										            <form class="form-horizontal" method="POST" action="/head_quater/storeBankIncome">
										            	{{ csrf_field() }}
										            	<input type="hidden" name="accountHead" value="3" >
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Bank Name</label>
										                  		<div class="col-sm-10">
											                  		<select class="form-control" name="bank" required>
											                  			<option>-----select bank-----</option>
											                  		@foreach($banks as $bank)
											                  			<option value="{{$bank->id}}">{{$bank->name}}</option>
											                  		@endforeach
												                  	</select>
										                  		</div>
										                	</div>
											                <div class="radio">
										                    	<label style="margin-left: 17%;">
										                    		<input type="radio" name="optionsRadios" id="optionsRadios1" value="cash" required>
										                    		Cash
										                    	</label>
										                    	<label style="margin-left: 2%;">
										                      		<input type="radio" name="optionsRadios" id="optionsRadios2" value="bank" required>
										                      		Bank
										                    	</label>
									                  		</div>
									                		<br>
											                <!-- Total loan amount -->
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Total Loan Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control" name="amount">
											                			<span class="input-group-addon">Kyats</span>
											                		</div>
											                	</div>
											                </div>

											                <!-- Loan Date -->
															<div class="form-group">
																<label for="inputamount" class="col-sm-2 control-label">Loan Date</label>
																<div class="col-sm-10">
																	<div class="input-group date">
																		<div class="input-group-addon">
																			<i class="fa fa-calendar"></i>
																		</div>
																		<input type="text" class="form-control pull-right" id="load_date" name="loan_date">
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
							<!-- /. BankLoan tab-pane -->
							
							<!-- PO tab-pane -->
							{{--<div class="tab-pane" id="tab_4">--}}
								{{--<section class="content">--}}
										{{--<div class="row">--}}
											{{--<div class="col-md-12">--}}
												{{--<!-- <div class="box box-info"> -->--}}
													{{--<div class="box-header with-border">--}}
														{{--<h3 class="box-title">Amount Form Payment Order</h3>--}}
										            {{--</div>--}}
										            {{--<!-- form start -->--}}
										            {{--<form class="form-horizontal" method="POST" action="/head_quater/storePaymentOrderIncome">--}}
										            	{{--{{ csrf_field() }}--}}
										            	{{--<input type="hidden" name="accountHead" value="4" >--}}
										              	{{--<div class="box-body">--}}
										                	{{--<div class="form-group">--}}
										                  		{{--<label for="investor_name" class="col-sm-2 control-label">Payment Order Name</label>--}}
										                  		{{--<div class="col-sm-10">--}}
											                  		{{--<select class="form-control" name="paymentorder" required>--}}
											                  			{{--<option>-----select payment order-----</option>--}}
											                  		{{--@foreach($paymentOrders as $paymentOrder)--}}
											                  			{{--<option value="{{$paymentOrder->id}}">{{$paymentOrder->name}}</option>--}}
											                  		{{--@endforeach--}}
												                  	{{--</select>--}}
										                  		{{--</div>--}}
										                	{{--</div>--}}
											                {{----}}


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


											                {{--<div class="form-group">--}}
											                	{{--<label for="inputamount" class="col-sm-2 control-label">Amount</label>--}}
											                	{{--<div class="col-sm-10">--}}
											                		{{--<div class="input-group">--}}
											                			{{--<span class="input-group-addon">$</span>--}}
											                			{{--<input type="text" id="inputamount" class="form-control" name="amount">--}}
											                			{{--<span class="input-group-addon">Kyats</span>--}}
											                		{{--</div>--}}
											                	{{--</div>--}}
											                {{--</div>--}}

											                {{--<div class="form-group">--}}
											                	{{--<label for="inputamount" class="col-sm-2 control-label">With Draw</label>--}}
											                	{{--<div class="col-sm-10">--}}
																	{{--<div class="input-group date">--}}
																		{{--<div class="input-group-addon">--}}
																			{{--<i class="fa fa-calendar"></i>--}}
																		{{--</div>--}}
																		{{--<input type="text" class="form-control pull-right" id="with_draw" name="receive_date">--}}
																	{{--</div>--}}
																{{--</div>--}}
											                {{--</div>--}}
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
										            		{{--<button type="submit" class="btn btn-default">Cancel</button>--}}
										                	{{--<button type="submit" class="btn btn-info pull-right">Add Amount</button>--}}
										              	{{--</div>--}}
										              	{{--<!-- /.box-footer -->--}}
										            {{--</form>--}}
										        {{--<!-- </div> -->--}}
										    {{--</div>--}}
										{{--</div>--}}
								{{--</section>--}}
							{{--</div>--}}
					      	<!-- /. PO tab-pane -->

					      	<!-- PG tab-pane -->
					      	<div class="tab-pane" id="tab_6">
								<section class="content">
										<div class="row">
											<div class="col-md-12">
												<!-- <div class="box box-info"> -->
													<div class="box-header with-border">
														<h3 class="box-title">Amount Form Purchase Guarantee</h3>
										            </div>
										            <!-- form start -->
										            <form class="form-horizontal" method="POST" action="/head_quater/storePurchaseGuaranteeIncome">
										            	{{ csrf_field() }}
										            	<input type="hidden" name="accountHead" value="5" >
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="purchase_guarantee" class="col-sm-2 control-label">Purchase Guarantee Name</label>
										                  		<div class="col-sm-10">
											                  		<select class="form-control" name="purchaseguarantee" required>
											                  			<option>----- select purchase guarantee -----</option>
											                  		@foreach($purchaseGuarantees as $purchaseguarantee)
											                  			<option value="{{$purchaseguarantee->id}}">{{$purchaseguarantee->name}}</option>
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
																		<input type="text" class="form-control pull-right" id="pg_with_draw" name="receive_date">
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
										            		<a href="/purchase_guarantee" class="btn btn-default">Cancel</a>
										                	<button type="submit" class="btn btn-info pull-right">Add Amount</button>
										              	</div>
										              	<!-- /.box-footer -->
										            </form>
										        <!-- </div> -->
										    </div>
										</div>
								</section>
							</div>
					      	<!-- /. PG tab-pane -->
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
    });
    $('#with_draw').datepicker({
    	autoclose:true
    });
    $('#pg_with_draw').datepicker({
    	autoclose:true
    });
</script>
@endsection