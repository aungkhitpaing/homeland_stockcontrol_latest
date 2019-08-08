@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Register Investor Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        <form class="form-horizontal">
	          <div class="box-body">
	            <div class="form-group">
	              <label for="Investorname" class="col-sm-2 control-label">Investor Name</label>

	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="Investorname" placeholder="Name">
	              </div>
	            </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <button type="submit" class="btn btn-default">Cancel</button>
	            <button type="submit" class="btn btn-info pull-right">Add</button>
	          </div>
	          <!-- /.box-footer -->
	        </form>
	      </div>
	      <!-- /.box -->
	    </div>
        <!--/.col (right) -->
    </div>

    <div class="row">
      
      <div class="col-md-12">
        <div class="box" style="border: none;">
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Investor Name</th>
                  <th>Created Date</th>
                  <th>Action</th>                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Investor01</td>
                  <td>18 Aug 2019</td>
                  <td>
                    <a href="/investor/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/investor/edit" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Investor02</td>
                  <td>18 Aug 2019</td>
                  <td>
                    <a href="/investor/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/investor/edit" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Investor03</td>
                  <td>18 Aug 2019</td>
                  <td>
                    <a href="/investor/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/investor/edit" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Investor04</td>
                  <td>18 Aug 2019</td>
                  <td>
                    <a href="/investor/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/investor/edit" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>                
              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Investor Name</th>
                  <th>Created Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
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