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
                  {{-- <li><a href="/head_quater/income_cashbook">Investor</a></li> --}}
                  <li class="active"><a href="/head_quater/income_cashbook/bank_loan">Bank Loan</a></li>
                  {{-- <li><a href="#tab_3" data-toggle="tab">Bank Loan</a></li> --}}
                  {{-- <li><a href="#tab_4" data-toggle="tab">PO/PG</a></li> --}}
                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
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
                                        {{--<input type="hidden" name="accountHead" value="3" >--}}
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Account Head</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="accountHead" required>
                                                    <option disabled selected>--- Select your option ---</option>
                                                    @foreach($accountHead as $data)
                                                        <option value="{{$data->id}}">{{$data->account_head_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

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
                                            <a href="/head_quater/income_cashbook/bank_loan/" class="btn btn-default">Cancel</a>
                                            <button type="submit" class="btn btn-info pull-right">Add Amount</button>
                                          </div>
                                          <!-- /.box-footer -->
                                    </form>
                                <!-- </div> -->
                            </div>
                        </div>
                </section>
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
   $('#load_date').datepicker({
      autoclose: true
    });
    $('#with_draw').datepicker({
    	autoclose:true
    });
    $('#pg_with_draw').datepicker({
    	autoclose:true
    });
    
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