@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Payment Order Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($editPaymentOrder as $paymentOrder)
	        <form class="form-horizontal" method="POST" action="/payment_order/{{$paymentOrder->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">
	              <div class="form-group">
	                <label for="po_name" class="col-sm-2 control-label">Payment Order Name</label>
	                <div class="col-sm-10">
	                  <input type="text" class="form-control" id="po_name" name="po_name" value="{{$paymentOrder->name}}" placeholder="Enter the payment order name" required>
	                </div>
	              </div>

	              <!-- investor code  -->
	              <div class="form-group">
	                <label for="po_code" class="col-sm-2 control-label">Payment Order Code</label>
	                <div class="col-sm-10">
	                <?php
                		$code = explode("_",$paymentOrder->code)                	 
                	?>
	                  <input type="number" class="form-control" id="po_code" value="{{$code[1]}}" name="po_code" placeholder="Enter the payment order code" required>
	                </div>
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