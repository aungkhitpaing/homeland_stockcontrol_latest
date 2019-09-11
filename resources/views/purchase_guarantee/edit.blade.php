@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Purchase Guarantee Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($editPurchaseGuarantee as $purchaseGuarantee)
	        <form class="form-horizontal" method="POST" action="/purchase_guarantee/{{$purchaseGuarantee->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">
	              <div class="form-group">
	                <label for="pg_name" class="col-sm-2 control-label">Purchase Guarantee Name</label>
	                <div class="col-sm-10">
	                  <input type="text" class="form-control" id="pg_name" name="pg_name" value="{{$purchaseGuarantee->name}}" placeholder="Enter the purchase guarantee name" required>
	                </div>
	              </div>

	              <!-- investor code  -->
	              <div class="form-group">
	                <label for="pg_code" class="col-sm-2 control-label">Purchase Guarantee Code</label>
	                <div class="col-sm-10">
	                <?php
                		$code = explode("_",$purchaseGuarantee->code)                	 
                	?>
	                  <input type="number" class="form-control" id="pg_code" value="{{$code[1]}}" name="pg_code" placeholder="Enter the purchase guarantee code" required>
	                </div>
	              </div>
	            </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/purchase_guarantee/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="store_purchase_guarantee" value="Update">
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