@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="/head_quater/expend_cashbook">Office Expense</a></li>
                  <li><a href="/head_quater/project">Project</a></li>
                  {{--<li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>--}}
                  {{--<li><a href="#tab_4" data-toggle="tab">PO</a></li>--}}
                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Paid</a></li> -->

                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_expend">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                        </a>
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
                                  <th>Expense Category</th>
                                  <th>Account Head</th>
                                  <th>Payment Type</th>
                                  <th>Amount</th>
                                  <th>Description</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllOfficeExpense as $getOfficeExpense)
                                <tr>
                                  <td>{{$getOfficeExpense->expense_category_name}}</td>
                                  <td>{{$getOfficeExpense->account_head_type}}</td>
                                  <td>{{$getOfficeExpense->payment_type}}</td>
                                  <td>{{$getOfficeExpense->amount}}</td>
                                  <td>{{$getOfficeExpense->description}}</td>
                                  <?php
                                    $created_at = explode(" ", $getOfficeExpense->created_at);
                                  ?>
                                  <td>{{$created_at['0']}}</td>
                                  <td>
                                    <a href="/head_quater/office_expense_detail/{{$getOfficeExpense->office_expense_detail_id}}/edit"  class="btn btn-block btn-warning btn-sm">Edit</a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Expense Category</th>
                                  <th>Account Head</th>
                                  <th>Payment Type</th>
                                  <th>Amount</th>
                                  <th>Description</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>

                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                  </section>
                  {{--total amount of expend--}}
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-default">
                        <div class="box-header with-border">
                          <i class="fa fa-bullhorn"></i>
                          <h3 class="box-title">Total Office Expend Amount</h3>
                        </div>
                        <div class="box-body">
                          <div class="callout callout-danger">
                            <h4>Total expend amount is <b>{{$getTotalOfficeExpense}}</b> <span>Kyats</span></h4>
                            <p>This is all calculation amount of total income</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab_2">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_expend">
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
                                <th>Total Balance </th>
                                <th>Created Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($getAllProjectExpense as $getprojectexpense)
                                <tr>
                                  <td><a href="/head_quater/project_expense_detail/{{$getprojectexpense->project_id}}">{{$getprojectexpense->name}}</a></td>
                                  <td>{{$getprojectexpense->total_expense_balance}}</td>
                                    <?php
                                      $created_at = explode(" ", $getprojectexpense->created_at);
                                    ?>
                                  <td>{{$created_at[0]}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Project Name</th>
                                <th>Total Balance </th>
                                <th>Created Date</th>
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
                <div class="tab-pane" id="tab_3">
                  <section class="content">
                      <div class="row">
                        <div class="col-md-2 pull-right">
                          <a href="/head_quater/add_expend">
                            <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                          </a>
                        </div>
                        <div class="col-md-12">
                          <div class="box" style="border: none;">
                            <div class="box-header">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
<!--                                     <th>Id</th> -->
                                    <th>Title</th>
                                    <th>Payback Amount</th>
                                    <th>Payment Type</th>
                                    <th>payback Date</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($getAllBankExpense as $getBankExpense)
                                  <tr>
                                    <td>{{$getBankExpense->description}}</td>
                                    <td>{{$getBankExpense->payback_amount}}</td>
                                    <td>{{$getBankExpense->payment_type}}</td>
                                      <?php
                                        $created_at = explode(" ", $getBankExpense->created_at);
                                      ?>
                                    <td>{{$created_at[0]}}</td>
                                    <td>
                                      <a href="/head_quater/bank_expense_detail/{{$getBankExpense->id}}/edit" class="btn btn-block btn-warning btn-sm">Edit</a>
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>Title</th>
                                    <th>Payback Amount</th>
                                    <th>Payment Type</th>
                                    <th>payback Date</th>
                                    <th>Action</th>
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
                <div class="tab-pane" id="tab_4">
                  <section class="content">
                      <div class="row">
                        <div class="col-md-2 pull-right">
                          <a href="/head_quater/add_expend">
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
                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Amount</th>
                                    <th>With Draw</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>Project A</td>
                                    <td>100,000,000</td>
                                    <td>18 Jun 2019</td>
                                    <td>
                                      <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>Project B</td>
                                    <td>100,000,000</td>
                                    <td>18 Jun 2019</td>
                                    <td>
                                      <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>3</td>
                                    <td>Project C</td>
                                    <td>100,000,000</td>
                                    <td>18 Jun 2019</td>
                                    <td>
                                      <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </td>
                                  </tr>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Amount</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
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
                <div class="tab-pane" id="tab_6"></div>
                <div class="tab-pane" id="tab_7"></div>
              </div>
            </div>
            <!-- nav-tabs-custom -->
        </div>
      <!-- /.col -->
      </div>
    </section>
<!-- /.content -->
@endsection

@section('page_scripts')
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable()
    // $('#example3').DataTable()
    $('#example4').DataTable()
  })
</script>
@endsection