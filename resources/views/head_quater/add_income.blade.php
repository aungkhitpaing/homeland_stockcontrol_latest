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
		                  	<li><a href="#tab_4" data-toggle="tab">PO</a></li>
		                  	<li><a href="#tab_6" data-toggle="tab">PG</a></li>
		                  	<li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li>		                  	
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
									            <form class="form-horizontal">
									              	<div class="box-body">
									                	<div class="form-group">
									                  		<label for="investor_name" class="col-sm-2 control-label">Investor Name</label>
									                  		<div class="col-sm-10">
										                  		<!-- select -->
										                  		<select class="form-control">
										                  			<option value="#">Investor 1</option>
												                    <option value="#">Investor 2</option>
												                    <option value="#">Investor 3</option>
												                    <option value="#">Investor 4</option>
											                  	</select>
									                  		</div>
									                	</div>
									                  	<div class="radio">
									                    	<label style="margin-left: 17%;">
									                    		<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
									                    		Cash
									                    	</label>
									                    	<label style="margin-left: 2%;">
									                      		<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
									                      		Bank
									                    	</label>
									                  	</div>
									                	<br>
										                <div class="form-group">
										                	<label for="inputamount" class="col-sm-2 control-label">Amount</label>
										                	<div class="col-sm-10">
										                		<div class="input-group">
										                			<span class="input-group-addon">$</span>
										                			<input type="text" id="inputamount" class="form-control" required>
										                			<span class="input-group-addon">.00</span>
										                		</div>
										                	</div>
										                </div>

										                <div class="form-group">
										                	<label for="inputamount" class="col-sm-2 control-label">Description</label>
										                	<div class="col-sm-10">
										                		<div class="input-group">
										                			<span class="input-group-addon"></span>
										                			<input type="text" id="inputamount" class="form-control" required>
										                			<span class="input-group-addon"></span>
										                		</div>
										                	</div>
										                </div>
									            	</div>
									            	<!-- /.box-body -->

									            	<div class="box-footer">
									            		<button type="submit" class="btn btn-default">Cancel</button>
									                	<a href="/head_quater/income_cashbook" class="btn btn-info pull-right">Add Amount</a>
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
										            <form class="form-horizontal">
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Project Name</label>
										                  		<div class="col-sm-10">
											                  		<!-- select -->
											                  		<select class="form-control">
											                  			<option>Project 1</option>
													                    <option>Project 2</option>
													                    <option>Project 3</option>
												                  	</select>
										                  		</div>
										                	</div>
										                	<div class="radio">
										                    	<label style="margin-left: 17%;">
										                    		<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
										                    		Cash
										                    	</label>
										                    	<label style="margin-left: 2%;">
										                      		<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
										                      		Bank
										                    	</label>
									                  		</div>
									                		<br>
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control">
											                			<span class="input-group-addon">.00</span>
											                		</div>
											                	</div>
											                </div>
										            	</div>
										            	<!-- /.box-body -->

										            	<div class="box-footer">
										            		<button type="submit" class="btn btn-default">Cancel</button>
										                	<a href="/head_quater/income_cashbook" class="btn btn-info pull-right">Add Amount</a>
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
										            <form class="form-horizontal">
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Bank Name</label>
										                  		<div class="col-sm-10">
											                  		<!-- select -->
											                  		<select class="form-control">
											                  			<option>AYA Bank</option>
													                    <option>KBZ Bank</option>
													                    <option>CB Bank</option>
													                    <option>MOB Bank</option>
													                    <option>AGD Bank</option>
												                  	</select>
										                  		</div>
										                	</div>
											                
											                <!-- Total loan amount -->
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Total Loan Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control">
											                			<span class="input-group-addon">.00</span>
											                		</div>
											                	</div>
											                </div>

											                <!-- Current Amount -->
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Currently Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control">
											                			<span class="input-group-addon">.00</span>
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
																		<input type="text" class="form-control pull-right" id="load_date">
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
							<!-- /. BankLoan tab-pane -->
							
							<!-- PO tab-pane -->
							<div class="tab-pane" id="tab_4">
								<section class="content">
										<div class="row">
											<div class="col-md-12">
												<!-- <div class="box box-info"> -->
													<div class="box-header with-border">
														<h3 class="box-title">Amount Form Project</h3>
										            </div>
										            <!-- form start -->
										            <form class="form-horizontal">
										              	<div class="box-body">
										                	<div class="form-group">
										                  		<label for="investor_name" class="col-sm-2 control-label">Project Name</label>
										                  		<div class="col-sm-10">
											                  		<!-- select -->
											                  		<select class="form-control">
											                  			<option>Project 1</option>
													                    <option>Project 2</option>
													                    <option>Project 3</option>
													                    <option>Project 4</option>
													                    <option>Project 5</option>
												                  	</select>
										                  		</div>
										                	</div>
											                
											                <div class="form-group">
											                	<label for="inputamount" class="col-sm-2 control-label">Amount</label>
											                	<div class="col-sm-10">
											                		<div class="input-group">
											                			<span class="input-group-addon">$</span>
											                			<input type="text" id="inputamount" class="form-control">
											                			<span class="input-group-addon">.00</span>
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
																		<input type="text" class="form-control pull-right" id="with_draw">
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
					      <!-- /. PO tab-pane -->
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