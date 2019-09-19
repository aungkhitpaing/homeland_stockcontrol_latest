@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Exchange Transfer Lists</h3>
            <a href="/exchange_transfer/create" class="btn btn-primary btn-sm pull-right">Exchange </a>

	        </div>
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Description</th>                  
                    <th>Transfer Amount</th>
                    <th>Payment Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="" class="btn btn-warning btn-sm">Edit</a></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Description</th>                  
                    <th>Transfer Amount</th>
                    <th>Payment Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>   
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	      </div>
	      <!-- /.box -->
	    </div>                      
    </div>
</section>

@endsection
@section('page_scripts')
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
@endsection