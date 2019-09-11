@extends('layouts.app')

@section('content')
	<section class="content-header">
      <h1>
      	Detail of Invoice
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Expense</a></li>
        <li><a href="#">Invoice</a></li>
        <li class="active">Detail page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Invoice Id - <b>S-001</b></h3>

          <!-- <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> -->
        </div>
        <div class="box-body">
          <img src="/image/invoice-template-blue.png" width="600" height="800">
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Total Amount - <b>100000 Kyats</b>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
@endsection
