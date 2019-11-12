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
                  <li><a href="#tab_1" data-toggle="tab">Investor</a></li>
                  <li><a href="/head_quater/income_cashbook/project">Project</a></li>
                  <li class="active"><a href="/head_quater/income_cashbook/bank_loan">Bank Loan</a></li>
                  <li><a href="/head_quater/income_cashbook/po_pg">PO/PG</a></li>

                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">
              <!-- Investor tab-pane -->
                
              <!-- /.tab-pane -->

              <!-- Bank Loan -->
              <div>
                <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/bank_loan/create">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                        </a>
                      </div>
                      <div class="col-md-12">
                        <div class="box" style="border: none;">
                          <div class="box-header">
                          </div>
                          <div class="box-body">
                            <table id="example3" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                    <th>Title</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Date</th>
                                    <th>Payback Amount</th>
                                    <th>Left to Paid</th>
                                    <th>Option</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($loanDetail as $loanDetailById)
                                <tr>
                                  <td>{{$loanDetailById->description}}</td>
                                  @if ($loanDetailById->loan_amount == null)
                                    <td>0 Kyats</td>
                                  @else
                                    <td>{{$loanDetailById->loan_amount}} Kyats</td>
                                  @endif
                                  <td>{{$loanDetailById->loan_date}}</td>
                                  @if ($loanDetailById->payback_amount == null)
                                    <td>0 Kyats</td>
                                  @else
                                    <td>{{$loanDetailById->payback_amount}} Kyats</td>
                                  @endif

                                  @if ( $loanDetailById->payback_amount == null)
                                    <td>
                                      {{$loanDetailById->loan_amount - 0 }} Kyats
                                    </td>
                                  @else
                                    <td>
                                      {{$loanDetailById->loan_amount - $loanDetailById->payback_amount}} Kyats
                                    </td>
                                  @endif
                                  <td>
                                      @if($loanDetailById->loan_amount == $loanDetailById->payback_amount)
                                          <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                                          @else
                                             <a href="/head_quater/add_expend/bank/{{$loanDetailById->id}}" class="btn btn-success btn-sm">PayBack</a>
                                            <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                      @endif
                                      <a href="/head_quater/loan_detail/{{$loanDetailById->id}}/show" class="btn btn-primary btn-sm">Detail</a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Title</th>
                                <th>Loan Amount</th>
                                <th>Loan Date</th>
                                <th>Payback Amount</th>
                                <th>Left to Paid</th>
                                <th>Option</th>
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