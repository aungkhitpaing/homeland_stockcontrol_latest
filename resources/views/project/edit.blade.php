@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Project Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($editProject as $project)
	        <form class="form-horizontal" method="POST" action="/project/{{$project->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">
              <!-- investor name -->
	            <div class="form-group">
	              <label for="projectname" class="col-sm-2 control-label">Project Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="projectname" name="project_name" value="{{$project->name}}" placeholder="Enter the project name" required>
	              </div>
	            </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="Investorname" class="col-sm-2 control-label">Project Code</label>
                <div class="col-sm-10">
                <?php
                	$code = explode("_",$project->code)                	 
                ?>
                  <input type="number" class="form-control" id="projectcode" value="{{$code[1]}}" name="project_code" placeholder="Enter the investor code" required>
                </div>
              </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/project/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="store_project" value="Update">
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