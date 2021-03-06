@extends('layouts.app')

@section('content')
<section class="content">
  	<div class="row">
	  	<!-- right column -->
	    <div class="col-md-12">
	      <!-- Horizontal Form -->
	      <div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Investor Form</h3>
	        </div>
	        <!-- /.box-header -->
	        <!-- form start -->
	        @foreach($editInvestor as $investor)
	        <form class="form-horizontal" method="POST" action="/investor/{{$investor->id}}/update">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
	          <div class="box-body">
              <!-- investor name -->
	            <div class="form-group">
	              <label for="Investorname" class="col-sm-2 control-label">Investor Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="Investorname" name="investor_name" value="{{$investor->name}}" placeholder="Enter the investor name" required>
	              </div>
	            </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="Investorname" class="col-sm-2 control-label">Investor Code</label>
                <div class="col-sm-10">
                <?php
                	$code = explode("_",$investor->code)                	 
                ?>
                  <input type="number" class="form-control" id="investorcode" value="{{$code[1]}}" name="investor_code" placeholder="Enter the investor code" required>
                </div>
              </div>
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer">
	            <a href="/investor/" class="btn btn-default">Back</a>
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