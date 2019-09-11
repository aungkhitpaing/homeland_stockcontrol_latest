@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Register Project Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        <form class="form-horizontal" method="POST" action="/project/store">
            {{ csrf_field() }}
	          <div class="box-body">
              <!-- investor name -->
	            <div class="form-group">
	              <label for="projectname" class="col-sm-2 control-label">Project Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="projectname" name="project_name" placeholder="Enter the project name" required>
	              </div>
	            </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="projectcode" class="col-sm-2 control-label">Project Code</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="projectcode" name="project_code" placeholder="Enter the project code" required>
                </div>
              </div>
	          </div>

	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/project/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="store_investor" value="Add">
	          </div>
	          <!-- /.box-footer -->
	        </form>
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