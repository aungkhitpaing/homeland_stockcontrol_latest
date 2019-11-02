@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Add payment Order Data
            <small>Preview of UI elements</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Head_quater</a></li>
            <li class="active">Add_Payment Order</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Payment Order</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <div class="box box-info"> -->
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Amount Form Payment Order</h3>
                                        </div>
                                        <!-- form start -->
                                        <form class="form-horizontal" method="POST" action="/head_quater/storePaymentOrderIncome">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="accountHead" value="4" >
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="investor_name" class="col-sm-2 control-label">Payment Order Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="paymentorder" required>
                                                            @foreach($paymentOrders as $paymentOrder)
                                                                <option value="{{$paymentOrder->id}}">{{$paymentOrder->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="radio">
                                                    <label style="margin-left: 17%;">
                                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
                                                        Cash
                                                    </label>
                                                    <label style="margin-left: 2%;">
                                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
                                                        Bank
                                                    </label>
                                                </div>
                                                <br>

                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" id="inputamount" class="form-control" name="amount">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">With Draw</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" class="form-control pull-right" id="with_draw" name="receive_date">
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <button type="submit" class="btn btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-info pull-right">Add Amount</button>
                                            </div>
                                            <!-- /.box-footer -->
                                        </form>
                                        <!-- </div> -->
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
        //Date picker
        $('#load_date').datepicker({
            autoclose: true
        });
        $('#with_draw').datepicker({
            autoclose:true
        });
        $('#pg_with_draw').datepicker({
            autoclose:true
        });
    </script>
@endsection