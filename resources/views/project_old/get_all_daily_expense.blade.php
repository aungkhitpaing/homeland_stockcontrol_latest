@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Daily Expense Data Tables
    <small>advanced tables</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Expense Data tables</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Supplier</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Invoice</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/estimate/create">
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
                                  <th>Id</th>
                                  <th>Item Name</th>
                                  <th>Project Name</th>
                                  <th>Qty</th>
                                  <th>Unit</th>
                                  <th>Price</th>
                                  <th>Total Amount</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Item 1</td>
                                  <td>Project A</td>
                                  <td>10</td>
                                  <td>Unknown Unit</td>
                                  <td>10000 <span>Kyats</span></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Item 2</td>
                                  <td>Project A</td>
                                  <td>10</td>
                                  <td>Unknown Unit</td>
                                  <td>10000 <span>Kyats</span></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Item 3</td>
                                  <td>Project A</td>
                                  <td>10</td>
                                  <td>Unknown Unit</td>
                                  <td>10000 <span>Kyats</span></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>Item 4</td>
                                  <td>Project A</td>
                                  <td>10</td>
                                  <td>Unknown Unit</td>
                                  <td>10000 <span>Kyats</span></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>Item 5</td>
                                  <td>Project A</td>
                                  <td>10</td>
                                  <td>Unknown Unit</td>
                                  <td>10000 <span>Kyats</span></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                  </td>
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Item Name</th>
                                  <th>Project Name</th>
                                  <th>Qty</th>
                                  <th>Unit</th>
                                  <th>Price</th>
                                  <th>Total Amount</th>
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
                <div class="tab-pane" id="tab_2">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/estimate/create">
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
                                  <th>Invoice Id</th>
                                  <th>Project Name</th>
                                  <th>Image</th>
                                  <th>Total Amount</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>S-0001</td>
                                  <td>Project A</td>
                                  <td><img src="/image/invoice-template-blue.png" width="80" height="100"></td>
                                  <td>100,000 <span>Kyats</span> </td>
                                  <td>
                                    <a type="button" href="/dailyexpense/detail" class="btn btn-block btn-success btn-sm">Detail</a>
                                  </td>
                                </tr> 
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Invoice Id</th>
                                  <th>Project Name</th>
                                  <th>Image</th>
                                  <th>Total Amount</th>
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
        <div class="col-md-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Used of Estimate Cost</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Summary of Daily Expense</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Currently Usage Amount:</dt>
                <dd>300,000 <span>Kyats</span></dd>
                <dt>Pay for Left to Suppliers:</dt>
                <dd>500,000 <span>Kyats</span></dd>
                <dt>Remaining Total Amount:</dt>
                <dd>200,000 <span>Kyats</span></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
  })
</script>
@endsection