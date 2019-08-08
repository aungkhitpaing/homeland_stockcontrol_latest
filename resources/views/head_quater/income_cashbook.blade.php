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
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income" class="btn btn-block btn-primary btn-sm">Add</a>
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
                                  <th>Id</th>
                                  <th>Investor Name</th>
                                  <th>Balance</th>
                                  <th>Updated Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td><a href="/head_quater/invester_detail/1">Investor01</a></td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <!-- <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td> -->
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td><a href="/head_quater/invester_detail/1">Investor02</a></td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <!-- <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td> -->
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Investor Name</th>
                                  <th>Balance</th>
                                  <th>Updated Date</th>
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
                          <div class="box-body">
                            <div class="callout">
                              <h4> <span>Total investor income amount is</span> <b>200,000,000</b> <span>Kyats</span></h4>

                              <p>This is all calculation amount of total investor income</p>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="" class="btn btn-block btn-success btn-sm">
                          <i class="fa fa-download">
                            Export Excel
                          </i>
                        </a>
                      </div>                      
                    </div>
                  </section>
                </div>
              <!-- /.tab-pane -->

              <!-- Project tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income">
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
                                <th>Id</th>
                                <th>Project Name</th>
                                <th>Amount</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <td>1</td>
                                <td><a href="/project/project_income_details">Project 01</a>
                                </td>
                                <td>100,000,000</td>
                                <td>18 Jun 2019</td>
                                <td>18 Jun 2019</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td><a href="/project/project_income_details">Project 02</a>
                                </td>
                                <td>100,000,000</td>
                                <td>18 Jun 2019</td>
                                <td>18 Jun 2019</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                </td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td><a href="">Project 03</a>
                                </td>
                                <td>100,000,000</td>
                                <td>18 Jun 2019</td>
                                <td>18 Jun 2019</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                </td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td><a href="">Project 04</a>
                                </td>
                                <td>100,000,000</td>
                                <td>18 Jun 2019</td>
                                <td>18 Jun 2019</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                </td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td><a href="">Project 05</a>
                                </td>
                                <td>100,000,000</td>
                                <td>18 Jun 2019</td>
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
                                <th>Updated Date</th>
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
              <!-- /.tab-pane -->

              <!-- Bank Loan -->
              <div class="tab-pane" id="tab_3">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income">
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
                                  <th>Id</th>
                                  <th>Bank Name</th>
                                  <th>Loan Amount</th>
                                  <th>Loan Date</th>
                                  <th>Left Amount</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>AYA Bank
                                  </td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <td>100,000,000</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>KBZ BANK
                                  </td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <td>100,000,000</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>CB BANK
                                  </td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <td>100,000,000</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>MOB BANK
                                  </td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <td>100,000,000</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>AGD BANK
                                  </td>
                                  <td>100,000,000</td>
                                  <td>18 Jun 2019</td>
                                  <td>100,000,000</td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Invester Name</th>
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
              <!-- /.tab-pane -->

              <!-- Purchase Order -->
              <div class="tab-pane" id="tab_4">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income">
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
                                  <th>Invester Name</th>
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
              <!-- /.tab-pane -->

              <!-- PG -->
              <div class="tab-pane" id="tab_6">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income">
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
                                  <th>Invester Name</th>
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
              <!-- /.tab-pane -->

              <!-- Interest Receive -->
              <div class="tab-pane" id="tab_7">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/add_income">
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
                                  <th>Invester Name</th>
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
              <!-- /.tab-pane -->              


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

              <h3 class="box-title">Total Income Amount</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-success">
                <h4>Total income amount is <b>100,000,000</b> <span>Kyats</span></h4>

                <p>This is all calculation amount of total income</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
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