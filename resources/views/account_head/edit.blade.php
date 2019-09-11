@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Account Head Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($accountHead as $data)
	        <form class="form-horizontal" method="POST" action="/accounthead/{{$data->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">

	            <div class="form-group">
                <label for="accounthead_name" class="col-sm-2 control-label">Account Head Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="accounthead_name" name="accounthead_name" value="{{$data->account_head_type}}" placeholder="Enter the account head name" required>
                </div>
              </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="accounthead_code" class="col-sm-2 control-label">Account Head Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="investorcode" value="{{$data->account_head_code}}" name="accounthead_code" placeholder="Enter the account head code" required>
                </div>
              </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/accounthead/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="store_investor" value="Update">
	          </div>
	          <!-- /.box-footer -->
	        </form>
	        @endforeach  
	      </div>
	      <!-- /.box -->
	    </div>
        <!--/.col (right) -->
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