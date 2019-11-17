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
                  <li class="active"><a href="/head_quater/income_cashbook/project">Project</a></li>
                  <li><a href="/head_quater/income_cashbook/bank_loan">Bank Loan</a></li>
                  <li><a href="/head_quater/income_cashbook/po_pg">PO/PG</a></li>

                  {{--<li><a href="#tab_6" data-toggle="tab">PG</a></li>--}}
                  <!-- <li><a href="#tab_7" data-toggle="tab">Interest Receive</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
            
              <div class="tab-content">

                  <section class="content">
                    <div class="row">
                      <div class="col-md-2 pull-right">
                        <a href="/head_quater/project/create" class="btn btn-block btn-primary btn-sm">Add</a>
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
                                <th>Amount</th>
                                <th>Updated Date</th>
                                <th>Option</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($getAllProjectIncome as $getProjectIncome)
                              <tr>
                                <td><a href="/head_quater/project_detail/{{$getProjectIncome->project_id}}">{{$getProjectIncome->name}}</a>
                                </td>
                                <td>{{$getProjectIncome->total_income_balance}} Kyats</td>
                                <?php
                                  $created_at = explode(" ", $getProjectIncome->created_at);
                                ?>
                                <td>{{$created_at[0]}}</td>
                                <td>
                                    <a href="/head_quater/project_detail/{{$getProjectIncome->project_id}}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                              </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Project Name</th>
                                <th>Amount</th>
                                <th>Updated Date</th>
                                <th>Option</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>

                          {{ $getAllProjectIncome->links() }}
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
    $('#example1').DataTable({
      "paging":   false,
      "ordering": false,
      "info":     false,
      "searching": false
    })
  })
</script>
@endsection