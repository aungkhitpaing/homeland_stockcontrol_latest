@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Expend Bank Transfer Data
            <small>Preview of UI elements</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Head_quater</a></li>
            <li class="active">Add Bank Expend</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Bank Loan</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <div class="box box-info"> -->
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Amount Form Bank Loan</h3>
                                        </div>
                                        <!-- form start -->
                                        <form class="form-horizontal" method="POST" action="/head_quater/storeBankExpense">
                                        {{ csrf_field() }}
                                        <!-- <input type="hidden" name="accountHead" value="3" > -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="accounthead" class="col-sm-2 control-label"> Account Head</label>
                                                    <div class="col-sm-10">
                                                        <!-- select -->
                                                        <select class="form-control" name="accountHead" required>
                                                            <option selected="true" disabled="disabled" value="">Choose Account head</option>
                                                            @foreach($accountHeads as $accountHead)
                                                                <option value="{{$accountHead->id}}">{{$accountHead->account_head_type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="investor_name" class="col-sm-2 control-label">Loan Payback For</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="loan_transfer_id" required>
                                                            @foreach($getBankLoanTransfer as $getLoanTransfer)
                                                                <option value="{{$getLoanTransfer->id}}">{{$getLoanTransfer->description}}</option>
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

                                                <!-- Total loan amount -->
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Payback Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="number" id="inputamount" class="form-control" name="amount">
                                                            <span class="input-group-addon">Kyats</span>
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
                                                <a href="/bank/" class="btn btn-default">Cancel</a>
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
