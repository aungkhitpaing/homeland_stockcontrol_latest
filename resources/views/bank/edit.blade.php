@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Bank Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($editBank as $bank)
	        <form class="form-horizontal" method="POST" action="/bank/{{$bank->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">
              <!-- investor name -->
	            <div class="form-group">
	              <label for="bankname" class="col-sm-2 control-label">Bank Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="bankname" name="bank_name" value="{{$bank->name}}" placeholder="Enter the bank name" required>
	              </div>
	            </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="bankcode" class="col-sm-2 control-label">Bank Code</label>
                <div class="col-sm-10">
                <?php
                	$code = explode("_",$bank->code)                	 
                ?>
                  <input type="number" class="form-control" id="investorcode" value="{{$code[1]}}" name="bank_code" placeholder="Enter the bank code" required>
                </div>
              </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/bank/" class="btn btn-default">Back</a>
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