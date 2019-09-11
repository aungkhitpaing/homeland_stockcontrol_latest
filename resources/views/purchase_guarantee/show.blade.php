@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Show Payment Order Lists</h3>
            <a href="/purchase_guarantee/create" class="btn btn-primary btn-sm pull-right">Add PG</a>

	        </div>
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>PG Code</th>
                    <th>PG Name</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                @foreach ($purchase_guarantees as $purchase_guarantee)
                  <tr>
                    <td>{{$purchase_guarantee->code}}</td>
                    <td>{{$purchase_guarantee->name}}</td>
                    <td>
                      <a href="/purchase_guarantee/{{$purchase_guarantee->id}}/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/purchase_guarantee/{{$purchase_guarantee->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                @endforeach             
                </tbody>
                <tfoot>
                  <tr>
                    <th>PG Code</th>
                    <th>PG Name</th>
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