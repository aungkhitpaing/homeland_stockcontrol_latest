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
        <div class="box">
        <div class="box-header">
          <h3 class="box-title">Search with Date Range</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Date range:</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="reservation">
            </div>
            <!-- /.input group -->
          </div>
        </div>    
        </div> 
    </div>
  </div>

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
                    <th>Id</th>
                    <th>Loan Id</th>
                    <th>Loan Amount</th>
                    <th>Loan Date</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>L_001</td>
                    <td>50,000,000</td>
                    <td>18 Jun 2019</td>
                    <td>For issue one</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Loan Id</th>
                    <th>Loan Amount</th>
                    <th>Loan Date</th>
                    <th>Remark</th>
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
            <h4> <span>Total investor Transfer amount is</span> <b>200,000,000</b> <span>Kyats</span></h4>
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