@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase Guarantee Register Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="/purchase_guarantee/store">
            {{ csrf_field() }}
            <div class="box-body">
              <!-- investor name -->
              <div class="form-group">
                <label for="po_name" class="col-sm-2 control-label">Purchase Guarantee Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="po_name" name="pg_name" placeholder="Enter the purchase guarantee name" required>
                </div>
              </div>

              <!-- investor code  -->
              <div class="form-group">
                <label for="pg_code" class="col-sm-2 control-label">Purchase Guarantee Code</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="pg_code" name="pg_code" placeholder="Enter the purchase guarantee code" required>
                </div>
              </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <a href="/purchase_guarantee/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="store_paymentorder" value="Add">
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