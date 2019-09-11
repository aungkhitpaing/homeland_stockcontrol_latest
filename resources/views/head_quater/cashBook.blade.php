@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    All Transaction Data Tables
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">All Transaction</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">
              <!-- Investor tab-pane -->
                <div class="tab-pane active" id="tab_1">
                  <section class="content">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th >Id</th>
                                  <th>Specification Name</th>
                                  <th>Account Head</th>
                                  <th>Payment Type</th>
                                  <th>Credit</th>
                                  <th>Debit</th>
                                  <th>Balance</th>
                                  <th>Description</th>
                                  <th>Created_at</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($getTransactions as $getTransaction)
                                <tr>
                                  <td>{{$getTransaction->id}}</td>
                                  <td>{{$getTransaction->specification_id}}</td>
                                  <td>{{$getTransaction->account_head_type}}</td>
                                  <td>{{$getTransaction->payment_type}}</td>
                                  <td>{{$getTransaction->income}} </td>
                                  <td>{{$getTransaction->expend}} </td>
                                  <td>{{$getTransaction->balance}} Kyats</td>
                                  <td>{{$getTransaction->description}}</td>                                  
                                  <?php
                                    $updated_at = explode(" ", $getTransaction->updated_at);
                                  ?>
                                  <td>{{$updated_at[0]}}</td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Specifincation Name</th>
                                  <th>Account Head</th>
                                  <th>Payment Type</th>
                                  <th>Credit</th>
                                  <th>Debit</th>
                                  <th>Balance</th>
                                  <th>Description</th>
                                  <th>Created_at</th>
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
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
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
  })
</script>
@endsection