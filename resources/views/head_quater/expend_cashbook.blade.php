@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Expands Data Tables
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Office Expense</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Project</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li>
                  <!-- <li><a href="#tab_4" data-toggle="tab">PO</a></li>
                  <li><a href="#tab_6" data-toggle="tab">PG</a></li>
                  <li><a href="#tab_7" data-toggle="tab">Interest Paid</a></li> -->

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
                                  <th>Project</th>
                                  <!-- <th>Specification</th> -->
                                  <th>Total Amount</th>
                                  <th>Created Date</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllOfficeExpense as $getOfficeExpense)
                                <tr>
                                  <td><a href="/head_quater/office_expense_detail/project/{{$getOfficeExpense->project_id}}">{{$getOfficeExpense->name}}</a></td>
                                  <!-- <td> -->
                                    <!-- <a href="/head_quater/office_expense_detail/expense_cat/{{$getOfficeExpense->expense_category}}"> -->
                                       <!-- {{$getOfficeExpense->expense_category_name}} -->
                                    <!-- </a> -->
                                  <!-- </td> -->
                                  <td>{{$getOfficeExpense->total_expense_balance}}</td>
                                  <?php
                                    $created_at = explode(" ", $getOfficeExpense->created_at);
                                  ?>
                                  <td>{{$created_at['0']}}</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Project</th>
                                  <!-- <th>Specification</th> -->
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
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllProjectExpense as $getprojectexpense)
                              <tr>
                                <td><a href="/head_quater/project_expense_detail/{{$getOfficeExpense->project_id}}">{{$getprojectexpense->name}}</a></td>
                                <td>{{$getprojectexpense->total_expense_balance}}</td>
                                <td>{{$getprojectexpense->created_at}}</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                </td>
                              </tr>
                              @endforeach
                              </tr>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Project Name</th>
                                <th>Total Balance </th>
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
                                    <th>payback Amount</th>
                                    <th>payback Date</th>
                                    <!-- <th>Left Amount</th> -->
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($getAllBankExpense as $getBankExpense) 
                                  <tr>
                                  <!-- <td>{{$getBankExpense->id}}</td> -->
                                    <td>{{$getBankExpense->description}}</td>
                                    <td>{{$getBankExpense->payback_amount}}</td>
                                    <td>{{$getBankExpense->created_at}}</td>
                                    <td>
                                      <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <!-- <th>Id</th> -->
                                    <th>Title</th>
                                    <th>payback Amount</th>
                                    <th>payback Date</th>
                                    <!-- <th>Left Amount</th> -->
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

                <div class="tab-pane" id="tab_6">
                </div>

                <div class="tab-pane" id="tab_7">
                </div>

              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
      <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Total Expend Amount</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>Total expend amount is <b>100,000,000</b> <span>Kyats</span></h4>

                <p>This is all calculation amount of total income</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
    $('#example3').DataTable()
    $('#example4').DataTable()
  })
</script>
@endsection