@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Show Office Expense Categories Lists</h3>
            <a href="/expense_category/create" class="btn btn-primary btn-sm pull-right">Add Expense</a>

	        </div>
          <div class="box" style="border: none;">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="expense_cat_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Expense Category Code</th>
                    <th>Expense Category Name</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                @foreach ($getAllExpenseCategories as $getAllExpenseCategory)
                  <tr>
                    <td>{{$getAllExpenseCategory->expense_category_code}}</td>
                    <td>{{$getAllExpenseCategory->expense_category_name}}</td>
                    <td>
                      <a href="/expense_category/{{$getAllExpenseCategory->id}}/edit" class="btn btn-warning btn-sm">Edit</a> <a href="/expense_category/{{$getAllExpenseCategory->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                @endforeach             
                </tbody>
                <tfoot>
                  <tr>
                    <th>Expense Category Code</th>
                    <th>Expense Category Name</th>
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
    $('#expense_cat_table').DataTable()
  })
</script>
@endsection