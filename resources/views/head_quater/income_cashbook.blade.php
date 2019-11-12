@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Income Data Tables
    <small>advanced tables</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Data tables</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Investor</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Project</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>
                  <li><a href="#tab_4" data-toggle="tab">PO/PG</a></li>
                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">
              <!-- Investor tab-pane -->
                <div class="tab-pane active" id="tab_1">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/create" class="btn btn-block btn-primary btn-sm">Add</a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>Investor Name</th>
                                  <th>Balance</th>
                                  <th>Updated Date</th>
                                  <th>Option</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllInvestorIncome as $getInvestorIncome)
                                <tr>
                                  <td>
                                    <a href="/head_quater/invester_detail/{{$getInvestorIncome->investor_id}}"> {{$getInvestorIncome->name}}
                                    </a>
                                  </td>
                                  <td>{{$getInvestorIncome->total_income_balance}} Kyats</td>
                                  <?php
                                    $updated_at = explode(" ", $getInvestorIncome->updated_at);
                                  ?>
                                  <td>{{$updated_at[0]}}</td>
                                  <td>
                                      <a href="/head_quater/invester_detail/{{$getInvestorIncome->investor_id}}" class="btn btn-primary btn-sm">Detail</a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Investor Name</th>
                                  <th>Balance</th>
                                  <th>Updated Date</th>
                                  <th>Option</th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>                      
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-default" style="border: none;">
                          
                          <!-- /.box-header -->
                          <!-- <div class="box-body">
                            <div class="callout">
                              <h4> <span>Total investor income amount is</span> <b> Not available</b> <span>Kyats</span></h4>

                              <p>This is all calculation amount of total investor income</p>
                            </div>
                          </div> -->
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                      </div>
                      <!-- /.col -->
                    </div>
                  </section>
                </div>
              <!-- /.tab-pane -->

              <!-- Project tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/create">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                        </a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                            <!-- <h3 class="box-title">Data Table For Income CashBook</h3> -->
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Project Name</th>
                                <th>Amount</th>
                                <th>Updated Date</th>
                                <th>Option</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllProjectIncome as $getProjectIncome)
                              <tr>
                                <td><a href="/head_quater/project_detail/{{$getProjectIncome->project_id}}">{{$getProjectIncome->name}}</a>
                                </td>
                                <td>{{$getProjectIncome->total_income_balance}} Kyats</td>
                                <?php
                                  $created_at = explode(" ", $getProjectIncome->created_at);
                                ?>
                                <td>{{$created_at[0]}}</td>
                                <td>
                                    <a href="/head_quater/project_detail/{{$getProjectIncome->project_id}}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                              </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Project Name</th>
                                <th>Amount</th>
                                <th>Updated Date</th>
                                <th>Option</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>

                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                  </section>  
                </div>
              <!-- /.tab-pane -->

              <!-- Bank Loan -->
              <div class="tab-pane" id="tab_3">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/create">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                        </a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <div class="box-body">
                            <table id="example3" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                    <th>Title</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Date</th>
                                    <th>Payback Amount</th>
                                    <th>Left to Paid</th>
                                    <th>Option</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($loanDetail as $loanDetailById)
                                <tr>
                                  <td>{{$loanDetailById->description}}</td>
                                  @if ($loanDetailById->loan_amount == null)
                                    <td>0 Kyats</td>
                                  @else
                                    <td>{{$loanDetailById->loan_amount}} Kyats</td>
                                  @endif
                                  <td>{{$loanDetailById->loan_date}}</td>
                                  @if ($loanDetailById->payback_amount == null)
                                    <td>0 Kyats</td>
                                  @else
                                    <td>{{$loanDetailById->payback_amount}} Kyats</td>
                                  @endif

                                  @if ( $loanDetailById->payback_amount == null)
                                    <td>
                                      {{$loanDetailById->loan_amount - 0 }} Kyats
                                    </td>
                                  @else
                                    <td>
                                      {{$loanDetailById->loan_amount - $loanDetailById->payback_amount}} Kyats
                                    </td>
                                  @endif
                                  <td>
                                      @if($loanDetailById->loan_amount == $loanDetailById->payback_amount)
                                          <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                                          @else
                                             <a href="/head_quater/add_expend/bank/{{$loanDetailById->id}}" class="btn btn-success btn-sm">PayBack</a>
                                            <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                      @endif
                                      <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/show" class="btn btn-primary btn-sm">Detail</a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Title</th>
                                <th>Loan Amount</th>
                                <th>Loan Date</th>
                                <th>Payback Amount</th>
                                <th>Left to Paid</th>
                                <th>Option</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                </section>
              </div>
              <!-- /.tab-pane -->

              <!-- Purchase Order -->
              <div class="tab-pane" id="tab_4">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/create">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                        </a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example4" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Account Head</th>
                                    <th>Register Date</th>
                                    <th>Register Name</th>
                                    <th>Register Type</th>
                                    <th>Register Amount</th>
                                    <th>Payback Amount</th>
                                    <th>Left Amount</th>
                                    <th>Description</th>
                                    <th>Options</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($getAllTinderRegisteration as $data)

                                  <tr>
                                      <td>{{$data->account_head_type}}</td>
                                    <?php
                                    $registerDate = explode(" ", $data->register_date);
                                    ?>
                                    <td>{{$registerDate[0]}}</td>
                                    <td>{{$data->register_name}}</td>
                                      @if( ($data->register_type) == 0)
                                        <td>PO</td>
                                      @else
                                        <td>PG</td>
                                      @endif
                                    <td>{{$data->register_amount}}</td>
                                    <td>{{$data->payback_amount}}</td>

                                      @if(empty($data->payback_amount))
                                        <td>{{($data->register_amount) -  0}}</td>
                                      @else
                                        <td>{{($data->register_amount) - ($data->payback_amount)}} </td>
                                      @endif
                                    <td>{{$data->description}}</td>
                                    <td>
                                      @if($data->register_amount == $data->payback_amount)
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="/head_quater/tinder_registeration/payback/{{$data->id}}" class="btn btn-primary btn-sm">Detail</a>
                                      @else
                                        <a href="/head_quater/tinder_registeration/{{$data->id}}" class="btn btn-success btn-sm">PayBack</a>
                                        <a href="/head_quater/tinder_registeration/{{$data->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/head_quater/tinder_registeration/payback/{{$data->id}}" class="btn btn-primary btn-sm">Detail</a>
                                        {{--<a href="/head_quater/receive_paymentorder/{{$getAllPaymentOrder->payment_order_id}}/edit" class="btn btn-warning btn-sm">Edit</a>--}}
                                      @endif
                                      {{--<a href="/head_quater/tinder_payback/{{$data->id}}/show" class="btn btn-primary btn-sm">Detail</a>--}}
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Account Head</th>
                                  <th>Register Date</th>
                                  <th>Register Name</th>
                                  <th>Register Type</th>
                                  <th>Register Amount</th>
                                  <th>Payback Amount</th>
                                  <th>Left Amount</th>
                                  <th>Description</th>
                                  <th>Options</th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                </section>
              </div>
              <!-- /.tab-pane -->

              <!-- PG -->
              <div class="tab-pane" id="tab_6">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/create" class="btn btn-block btn-primary btn-sm">Add</a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example6" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>PG Name</th>
                                  <th>Total Amount</th>
                                  <th>With Draw</th>
                                  <th>Description</th>
                                  <th>Updated at</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllPurchaseGauranteeIncome as $getAllPurchaseGauranteeIncomeById)
                                <tr>
                                  <td><a href="/head_quater/purchase_guarantee_detail/{{$getAllPurchaseGauranteeIncomeById->purchase_guarantee_id}}">{{$getAllPurchaseGauranteeIncomeById->name}}</a></td>
                                  <td>{{$getAllPurchaseGauranteeIncomeById->total_income_balance}} Kyats</td>
                                  <td>{{$getAllPurchaseGauranteeIncomeById->with_draw}}</td>
                                  <td>{{$getAllPurchaseGauranteeIncomeById->description}}</td>
                                  <?php
                                    $updated_at = explode(" ", $getAllPurchaseGauranteeIncomeById->updated_at);
                                  ?>                                  
                                  <td>{{$updated_at[0]}}</td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>PG Name</th>
                                  <th>Total Amount</th>
                                  <th>With Draw</th>
                                  <th>Description</th>
                                  <th>Updated at</th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                </section>                
              </div>
              </div>
            </div>
        </div>
      <!-- /.col -->
      </div>
      {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
          {{--<div class="box box-default">--}}
            {{--<div class="box-header with-border">--}}
              {{--<i class="fa fa-bullhorn"></i>--}}

              {{--<h3 class="box-title">Total Income Amount</h3>--}}
            {{--</div>--}}
            {{--<!-- /.box-header -->--}}
            {{--<div class="box-body">--}}
              {{--<div class="callout callout-success">--}}
                {{--<h4>Total income amount is <b>Not Define Yet !</b></h4>--}}

                {{--<p>This is all calculation amount of total income</p>--}}
              {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.box-body -->--}}
          {{--</div>--}}
          {{--<!-- /.box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}
      {{--</div>--}}
      {{--</div>--}}
    </section>
<!-- /.content -->
@endsection

@section('page_scripts')
<script>
  $(function () {
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
    $('#example4').DataTable();
    $('#example6').DataTable();
    $('#example7').DataTable();
  })
</script>
@endsection