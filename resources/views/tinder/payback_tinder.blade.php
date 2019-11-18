@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Payback Data
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">PO/PG</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">

                        <!-- Investor tab-pane -->
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <div class="box box-info"> -->
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Tinder Registeration ( PO / PG ) </h3>
                                        </div>
                                        @foreach ($getData as $data)
                                        <!-- form start -->
                                        <form class="form-horizontal" method="POST" action="/head_quater/tinder_registeration/payback/{{$data->id}}">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="investor_name" class="col-sm-2 control-label">Account Head</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="account_head"  required>
                                                            <option  value="{{$data->id}}">{{$data->account_head}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Register Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" disabled class="form-control" id="" name="register_name" value="{{$data->register_name}}" placeholder="Register name">
                                                    </div>
                                                </div>

                                                <div class="radio">
                                                    @if($data->register_type == 0)
                                                        <label style="margin-left: 17%;">
                                                            <input type="radio" name="register_type" value="0" checked>
                                                            PO
                                                        </label>
                                                    @else
                                                        <label style="margin-left: 17%;">
                                                            <input type="radio" name="register_type" value="1" checked>
                                                            PG
                                                        </label>
                                                    @endif
                                                </div>
                                                <br>

                                                <div class="radio">
                                                    @if ($data->payment_type == "Cash")
                                                        <label style="margin-left: 17%;">
                                                            <input type="radio" name="payment_type" id="optionsRadios1" value="Cash"  checked>
                                                            Cash
                                                        </label>
                                                    @else
                                                        <label style="margin-left: 17%;">
                                                            <input type="radio" name="payment_type" id="optionsRadios2" value="Bank" checked>
                                                            Bank
                                                        </label>
                                                    @endif
                                                </div>
                                                <br>


                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Total Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="number" id="inputamount" class="form-control"  value="{{$data->register_amount}}" disabled name="register_amount">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Payback Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="number" id="inputamount" class="form-control payback" required name="payback_amount">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                        <p class="error-message" style="color:red"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">With Draw</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" class="form-control pull-right" id="pg_with_draw" required   name="register_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <textarea class="form-control" required  name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <a href="/head_quater/income_cashbook/po_pg" class="btn btn-default">Cancel</a>
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
        $('#pg_with_draw').datepicker({
            autoclose:true
        });
    </script>

<script>
    $(document).ready(function(){
        var original =   {{ $data->register_amount }}
        $('.payback').keyup(function(){
            $('.error-message').html('');
            var value = $('.payback').val();

            if(value > original){
                $('.payback').val('');
                $('.error-message').append('Your Payback amount is greater than register amount ');
            }

        })
    })
</script>

@endsection
