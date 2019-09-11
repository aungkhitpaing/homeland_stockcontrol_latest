@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Show Account Head Lists</h3>
            <a href="/accounthead/create" class="btn btn-primary btn-sm pull-right">Add Data</a>

	        </div>
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>AccountHead Code</th>
                    <th>Account Name</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                @foreach ($accountHeads as $accountHead)
                  <tr>
                    <td>{{$accountHead->account_head_code}}</td>
                    <td>{{$accountHead->account_head_type}}</td>
                    <td>
                      <a href="/accounthead/{{$accountHead->id}}/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/accounthead/{{$accountHead->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                @endforeach             
                </tbody>
                <tfoot>
                  <tr>
                    <th>AccountHead Code</th>
                    <th>Account Name</th>
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