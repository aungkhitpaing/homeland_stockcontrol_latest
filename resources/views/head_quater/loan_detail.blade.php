@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Loan Transfer Detail
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
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Payment Type</th>
                    <th>Payback Amount</th>
                    <th>Payback Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($loanDetail as $loanDetailById)
                  <tr>
                    <td>{{$loanDetailById->description}}</td>
                    <td>{{$loanDetailById->payment_type}}</td>
                    <td>{{$loanDetailById->payback_amount}}</td>
                      <?php
                        $paybackDate = explode(' ',$loanDetailById->created_at);
                      ?>
                    <td>{{$paybackDate[0]}}</td>
                    <td><a href="/head_quater/loan_detail/{{$loanDetailById->loan_transfer_id}}/show/{{$loanDetailById->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Payment Type</th>
                    <th>Payback Amount</th>
                    <th>Payback Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
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