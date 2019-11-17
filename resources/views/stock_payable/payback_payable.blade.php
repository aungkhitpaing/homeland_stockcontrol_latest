@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Income Data
            <small>Preview of UI elements</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Head_quater</a></li>
            <li class="active">Add_Income</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Payable</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Payable Stock </h3>
                                        </div>
                                        @foreach ($getData as $data)
                                        <form class="form-horizontal" method="POST" action="/stock_payable/{{$data->id}}/payback">
                                            {{ csrf_field() }}
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Stock Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="stock" required>
                                                            <option disabled selected>{{$data->stock_name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Project Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="project" required>
                                                            <option disabled selected>{{$data->name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Supplier Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="supplier" required>
                                                            <option disabled selected>{{$data->supplier_name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Quantity</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            {{--<span class="input-group-addon">$</span>--}}
                                                            <input type="number" id="inputamount" class="form-control" disabled value="{{$data->quantity}}" name="quantity">
                                                            {{--<span class="input-group-addon">Kyats</span>--}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Total Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            {{--<span class="input-group-addon">$</span>--}}
                                                            <input type="number" id="inputamount" class="form-control" disabled value="{{$data->total_amount}}" name="total_amount">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="radio">
                                                    <label style="margin-left: 17%;">
                                                        <input type="radio" name="payment_type" id="optionsRadios1" value="Cash" required>
                                                        Cash
                                                    </label>
                                                    <label style="margin-left: 2%;">
                                                        <input type="radio" name="payment_type" id="optionsRadios2" value="Bank" required>
                                                        Bank
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Payback Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            {{--<span class="input-group-addon">$</span>--}}
                                                            <input type="number" id="inputamount" class="form-control" name="payback_amount">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="box-footer">
                                                <a href="/stock_payable/" class="btn btn-default">Cancel</a>
                                                <button type="submit" class="btn btn-info pull-right">Payback</button>
                                            </div>
                                        </form>
                                    @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page_scripts')
    <script type="text/javascript">
        $('#load_date').datepicker({
            autoclose: true
        });
    </script>
@endsection