@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Payment Order Detail
    <small>advanced tables</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Loan tables</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Receive Amount</th>
                    <th>Receive Date</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($paymentOrderDetail as $paymentOrderDetailById)
                  <tr>
                    <td>{{$paymentOrderDetailById->receive_amount}} Kyats</td>
                    <td>{{$paymentOrderDetailById->receive_date}}</td>
                    <td>{{$paymentOrderDetailById->description}}</td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Receive Amount</th>
                    <th>Receive Date</th>
                    <th>Description</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="row">        
        <!-- /.col -->
        <div class="col-md-6">
          <div class="callout" style="background-color:lightpink">
            <h4> <span>Total investor Transfer amount is</span> <b>{{$totalBalance}}</b> <span>Kyats</span></h4>
            <p>This is all calculation amount of total investor income</p>
          </div>
        </div>        
        <!-- /.col -->

      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection
@section('page_scripts')
<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>
@endsection