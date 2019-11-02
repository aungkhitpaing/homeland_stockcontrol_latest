@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Order</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/project-order">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Stock Name</label>
                            <div class="col-sm-10">
                                <!-- select -->
                                <select class="form-control stock" name="stock" required>
                                    <option>Select Stock</option>
                                    @foreach(DB::table('stocks')->get() as $stock)
                                    <option value="{{$stock->id}}" required>{{$stock->stock_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="project" value="{{$projectName->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" id="" name="qty" class="form-control qty">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Stock Price</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" id="" name="price" class="form-control price" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" id="inputamount" name="amount" class="form-control amount">
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Create Order</button>
                        </div>
                    </form>
            </div>

            <div class="box box-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Stock Name</th>
                        <th>Stock Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Created Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datas as $data)
                      <tr>
                        <td>{{ $data->project_name->name }}</td>
                        <td>{{ \DB::table('stocks')->where('id',$data->stock_id)->first()->stock_name }}</td>
                        <td>{{ \DB::table('stocks')->where('id',$data->stock_id)->first()->price }}</td>
                        <td>{{ $data->quantity }}</td>
                        <th>{{ $data->amount }}</th>
                        <td>{{ $data->created_at }}</td>
    
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
        </div>
    </div>
</section>

@endsection
@section('page_scripts')
<script>
    $('.stock').on('change', function() {
        $('.amount').val('');
        $('.qty').val('');
        $('.price').val('');
        $.ajax({
            type:"GET",
            url:"/project-order/stock_price/"+this.value,
            success: function(data) {
                price = data.price;
            },
        });
    });

    $(".qty").on("change paste keyup", function() {
        $('.price').val(price);
        $('.amount').val(price * this.value);
    });
</script>
@endsection