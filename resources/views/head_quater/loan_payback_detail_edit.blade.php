@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Edit Loan Transfer Data
            <small>Preview of UI elements</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Head_quater</a></li>
            <li class="active">Edit Loan detail</li>
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
                                            <h3 class="box-title">Edit Loan detail transfer</h3>
                                        </div>
                                        <!-- form start -->
                                        <form class="form-horizontal" method="POST" action="/head_quater/loan_detail/{{$editLoanInfos->loan_transfer_id}}/show/{{$editLoanInfos->id}}/update">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                            <div class="box-body">
                                                <!-- Total loan amount -->
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Payback Amount</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="number" id="inputamount" class="form-control payback" value="{{$editLoanInfos->payback_amount}}" name="amount" autocomplete="off">
                                                            <span class="input-group-addon">Kyats</span>
                                                        </div>
                                                        <p class="error-message" style="color:red"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200">
                                                                {{$editLoanInfos->description}}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <a href="/head_quater/income_cashbook/bank_loan" class="btn btn-default">Cancel</a>
                                                <button type="submit" class="btn btn-info pull-right">Update </button>
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
