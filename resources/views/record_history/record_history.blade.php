@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All Records Histories Data Tables
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
            <li class="active"><a href="#tab_1" data-toggle="tab">Record Histories Transaction</a></li>
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
                            <th>Id</th>
                            <th>Description</th>
                            <th>Account Head</th>
                            <th>Update Amount</th>
                            <th>Original Amount</th>
                            <th>Change Status</th>
                            <th>Diff Amount</th>
                            <th>Created User</th>
                            <th>Created_At</th>
                            <th>Updated_At</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($getRecordHistories as $getRecord)
                            <tr>
                              <td>{{$getRecord->record_id}}</td>
                              <td>{{$getRecord->remark}}</td>
                              <td>{{$getRecord->account_head_type}}</td>
                              <td>{{$getRecord->transaction_update_amount}}</td>
                              <td>{{$getRecord->transaction_original_amount}}</td>
                              <td>{{$getRecord->change_status}}</td>
                              <td>{{$getRecord->diff_amount}}</td>
                              <td>{{$getRecord->created_user}}</td>
                              <?php
                                $created_at = explode(" ", $getRecord->created_at);
                              ?>
                              <td>{{$created_at[0]}}</td>
                              <?php
                                $updated_at = explode(" ", $getRecord->updated_at);
                              ?>
                              <td>{{$updated_at[0]}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Account Head</th>
                            <th>Update Amount</th>
                            <th>Original Amount</th>
                            <th>Change Status</th>
                            <th>Diff Amount</th>
                            <th>Created User</th>
                            <th>Created_At</th>
                            <th>Updated_At</th>
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
                    </div>
                  </div>
                </div>

                <div class="row">
                  <form method="POST" action="/head_quater/record_histories/excel">
                    {{ csrf_field() }}
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Account Head Type</label>
                        <select class="form-control" id="" name="account_head_type">
                          <option selected="true" disabled="disabled">Choose Account Head Type</option>
                          @foreach($account_head_types as $account_head)
                            <option value="{{ $account_head->account_head_type }}">
                              {{$account_head->account_head_type}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" class="form-control datepicker" id="datepicker" name="from_date"
                               required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">To Date</label>
                        <input type="date" class="form-control datepicker" id="datepicker" name="to_date"
                               required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Export</label>
                        <br>
                        <button type="submit" class="btn btn-success" >Excel Export</button>
                      </div>
                    </div>
                  </form>
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
    {{--</div>--}}
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