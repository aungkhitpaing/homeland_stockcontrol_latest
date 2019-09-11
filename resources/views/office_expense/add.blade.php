@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Register For Office Expense Category Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        <form class="form-horizontal" method="POST" action="/expense_category/store">
            {{ csrf_field() }}
	          <div class="box-body">
              <!-- investor name -->
	            <div class="form-group">
	              <label for="expense_cat" class="col-sm-2 control-label">Expense Category Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="expense_cat" name="expense_cat_name" placeholder="Enter the expense category name" required>
	              </div>
	            </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="expense_code" class="col-sm-2 control-label">Expense Category Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="expense_code" name="expense_code" placeholder="Enter the expense category code" required>
                </div>
              </div>
	          </div>

	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/expense_category/" class="btn btn-default">Back</a>
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
