@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Exchange Transfer</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="/exchange_transfer/store">
            {{ csrf_field() }}
            <div class="box-body">
                
                <div class="form-group">
                  <label for="accountHead" class="col-sm-2 control-label"> Account Head</label>
                    <div class="col-sm-10">
                      <!-- select -->
                      <select class="form-control" name="accountHead">
                          @foreach($accountHeads as $accountHead)
                          <option value="{{$accountHead->id}}">{{$accountHead->account_head_type}}</option>
                          @endforeach
                      </select>
                    </div>
                </div>

                <div class="form-group">
                  <label for="amount" class="col-sm-2 control-label">Amount To Exchange</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter the Transfer Amount" required>
                  </div>
                </div>

               <!--  <div class="radio">
                  <label style="margin-left: 17%;">
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
                      Cash
                  </label>
                  <label style="margin-left: 2%;">
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
                      Bank
                  </label>
                </div> -->
                
                <br>

                <div class="radio">
                  <label style="margin-left: 17%;">
                      <input type="radio" name="exchangeTypeRadios" id="optionsRadios1" value="0" required>
                      Cash to Bank
                  </label>
                  <label style="margin-left: 2%;">
                      <input type="radio" name="exchangeTypeRadios" id="optionsRadios2" value="1" required>
                      Bank to Cash
                  </label>
                </div>
                <br>

                <div class="form-group">
                  <label for="inputamount" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>
                    </div>
                  </div>
                </div>



            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <a href="/exchange_transfer/" class="btn btn-default">Back</a>
              <input type="submit" class="btn btn-info pull-right" name="exchange" value="Exchange">
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