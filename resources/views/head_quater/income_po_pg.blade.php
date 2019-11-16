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
                  <li><a href="/head_quater/income_cashbook">Investor</a></li>
                  <li><a href="/head_quater/income_cashbook/project">Project</a></li>
                  <li><a href="/head_quater/income_cashbook/bank_loan">Bank Loan</a></li>
                  <li class="active"><a href="/head_quater/income_cashbook/po_pg">PO/PG</a></li>
                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/po_pg/create">
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