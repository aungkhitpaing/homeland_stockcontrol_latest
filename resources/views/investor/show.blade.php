@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Show Investor Lists</h3>
            <a href="/investor/create" class="btn btn-primary btn-sm pull-right">Add Investor</a>

	        </div>
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Investor Code</th>
                    <th>Investor Name</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                @foreach ($investors as $investor)
                  <tr>
                    <td>{{$investor->id}}</td>
                    <td>{{$investor->code}}</td>
                    <td>{{$investor->name}}</td>
                    <td>
                      <a href="/investor/{{$investor->id}}/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/investor/{{$investor->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                  </tr>
                @endforeach             
                </tbody>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Investor Code</th>
                    <th>Investor Name</th>
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